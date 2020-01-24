let postId = 0;
let postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();

    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    let postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];

    console.log(postBody);
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {
            body: $('#post-body').val(),
            postId: postId,
            _token : ''
        }
    })
        .done(function (msg){
          //  console.log(JSON.stringify(msg));
            $(postBodyElement).text(msg['new_body']);
            $('#edit-modal').modal('hide');
        });
});

$('.like').on('click', function(event)
{
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    let isLike = event.target.previousElementSibling == null ;
    console.log(isLike);

    $.ajax({
        method: 'POST',
        url : urlLike,
        data: {
            isLike: isLike,
            postId: postId,
            _token: token
        }
    })
        .done(function () {
            event.target.innerText = isLike ? event.target.innerText =='Like' ? 'You Like this post':'Like': event.target.innerText == 'Dislike' ? 'You don\'t like this post': 'Dislike' ;
            if(isLike){
                event.target.nextElementSibling.innerText = 'Dislike';
            }
            else{
                event.target.previousElementSibling.innerText = 'Like';
            }
        })
});

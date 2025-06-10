// Для добавления комментариев
document.getElementById('commentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const commentText = document.getElementById('commentText').value;
    const commentsList = document.getElementById('commentsList');
    const newComment = document.createElement('li');
    newComment.textContent = commentText;
    commentsList.appendChild(newComment);
    document.getElementById('commentText').value = '';
});
jQuery(document).ready(function ($) {
    $('#load-books').on('click', function () {
        $.ajax({
            url: ajaxData.ajax_url,
            method: 'POST',
            data: {
                action: 'get_books', // This must match the PHP action
            },
            success: function (response) {
                if (Array.isArray(response)) {
                    let output = '<ul>';
                    response.forEach(function (book) {
                        output += `<li>
                            <h3>${book.name}</h3>
                            <p>Date: ${book.date}</p>
                            <p>Genre: ${book.genre.join(', ')}</p>
                            <p>${book.excerpt}</p>
                        </li>`;
                    });
                    output += '</ul>';
                    $('#book-list').html(output); // Display books in a container
                } else {
                    console.error('Unexpected response format:', response);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching books:', xhr.responseText);
            },
        });
    });
});
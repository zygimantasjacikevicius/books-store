require('./bootstrap');

// Delete Comfirmation
window.addEventListener('DOMContentLoaded', () => {
    const body = document.querySelector('body');
    if (document.querySelector('.cancel--confirm--button')) {
        document.querySelector('.cancel--confirm--button')
            .addEventListener('click', () => {
                body.style.overflow = 'auto';
                const modal = document.querySelector('#confirm-modal');
                modal.style.display = 'none';
            })
    }
    handleDeleteButtons();
});


// Handlers
const handleDeleteButtons = () => {
    document.querySelectorAll('.delete--button').forEach(b => {
        b.addEventListener('click', () => {
            const modal = document.querySelector('#confirm-modal');
            const body = document.querySelector('body');
            modal.style.display = 'flex';
            modal.style.top = window.scrollY + 'px';
            body.style.overflow = 'hidden';
            const form = modal.querySelector('form');
            form.setAttribute('action', b.dataset.action);
        })
    });
}

const pageSelector = () => {
    document.querySelector('#authors--pages')
        .querySelectorAll('a').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                getAuthorsList();
            })
        })
}


// Manage photos
const photoInput = `
    <button type="button" class="btn btn-danger">-</button>
    <input type="file" class="form-control mt-2" name="book_photo[]">
`;

window.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.add--photo')) {
        const addPhotoButton = document.querySelector('.add--photo');
        const inputPlaceholder = document.querySelector('.book--photos');
        addPhotoButton.addEventListener('click', () => {
            const span = document.createElement('span');
            span.innerHTML = photoInput;
            inputPlaceholder.appendChild(span);
            span.querySelector('button').addEventListener('click', () => {
                span.remove();
            })
        })
    }
});


const photoInputOutfit = `
    <button type="button" class="btn btn-danger">-</button>
    <input type="file" class="form-control mt-2" name="outfit_photo[]">
`;

window.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.add--photo--outfit')) {
        const addPhotoButton = document.querySelector('.add--photo--outfit');
        const inputPlaceholder = document.querySelector('.outfit--photos');
        addPhotoButton.addEventListener('click', () => {
            const span = document.createElement('span');
            span.innerHTML = photoInputOutfit;
            inputPlaceholder.appendChild(span);
            span.querySelector('button').addEventListener('click', () => {
                span.remove();
            })
        })
    }
});

// Authors List
if (document.querySelector('#authors')) {
    window.addEventListener('DOMContentLoaded', () => {
        // Sort Selector
        if (document.querySelector('#sort-select')) {
            document.querySelector('#sort-select').addEventListener('change', e => {
                document.querySelector('#authors--list').innerHTML = '<div class="loader"></div>';
                let sort;
                switch (e.target.value) {
                    case 'asc':
                        sort = '?sort=name_asc';
                        break;
                    case 'desc':
                        sort = '?sort=name_desc';
                        break;
                    case 'new_asc':
                        sort = '?sort=new_asc';
                        break;
                    case 'new_desc':
                        sort = '?sort=new_desc';
                        break;
                    default:
                        sort = '';
                }
                getAuthorsList(sort);
            })
        }
        // Page Selector
        const pageSelector = () => {
            document.querySelector('#authors--pages')
                .querySelectorAll('a').forEach(a => {
                    a.addEventListener('click', e => {
                        e.preventDefault();
                        document.querySelector('#authors--list .container').innerHTML = '<div class="loader"></div>';
                        getAuthorsList(a.getAttribute('href'));
                    })
                })
        }
        const getAuthorsList = (query = '') => {
            const url = document.querySelector('#authors--list').dataset.url;
            axios.get(url + query)
                .then(response => {
                    document.querySelector('#authors--list').innerHTML = response.data.html;
                    pageSelector();
                    handleDeleteButtons();
                })
        }
        // Handlers
        const handleDeleteButtons = () => {
            document.querySelectorAll('.delete--button').forEach(b => {
                b.addEventListener('click', () => {
                    const modal = document.querySelector('#confirm-modal');
                    const body = document.querySelector('body');
                    modal.style.display = 'flex';
                    modal.style.top = window.scrollY + 'px';
                    body.style.overflow = 'hidden';
                    const form = modal.querySelector('form');
                    form.setAttribute('action', b.dataset.action);
                })
            });
        }
        getAuthorsList();
    });
}


//Brands' list

if (document.querySelector('#brands')) {
    window.addEventListener('DOMContentLoaded', () => {
        // Sort Selector
        if (document.querySelector('#sort-select')) {
            document.querySelector('#sort-select').addEventListener('change', e => {
                document.querySelector('#brands--list').innerHTML = '<div class="loader"></div>';
                let sort;
                switch (e.target.value) {
                    case 'title_asc':
                        sort = '?sort=title_asc';
                        break;
                    case 'title_desc':
                        sort = '?sort=title_desc';
                        break;
                    case 'new_asc':
                        sort = '?sort=new_asc';
                        break;
                    case 'new_desc':
                        sort = '?sort=new_desc';
                        break;
                    default:
                        sort = '';
                }
                getAuthorsList(sort);
            })
        }
        // Page Selector
        const pageSelector = () => {
            document.querySelector('#brands--pages')
                .querySelectorAll('a').forEach(a => {
                    a.addEventListener('click', e => {
                        e.preventDefault();
                        document.querySelector('#brands--list .container').innerHTML = '<div class="loader"></div>';
                        getAuthorsList(a.getAttribute('href'));
                    })
                })
        }
        const getAuthorsList = (query = '') => {
            const url = document.querySelector('#brands--list').dataset.url;
            axios.get(url + query)
                .then(response => {
                    document.querySelector('#brands--list').innerHTML = response.data.html;
                    pageSelector();
                    handleDeleteButtons();
                })
        }
        // Handlers
        const handleDeleteButtons = () => {
            document.querySelectorAll('.delete--button').forEach(b => {
                b.addEventListener('click', () => {
                    const modal = document.querySelector('#confirm-modal');
                    const body = document.querySelector('body');
                    modal.style.display = 'flex';
                    modal.style.top = window.scrollY + 'px';
                    body.style.overflow = 'hidden';
                    const form = modal.querySelector('form');
                    form.setAttribute('action', b.dataset.action);
                })
            });
        }
        getAuthorsList();
    });
}
const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})
////
//const menuToggle = document.querySelector('.sidebar-toggle');
//menuToggle.addEventListener('click', () => {
  //sidebar.classList.toggle('open');
  //});
///////////////
    const iconMap = {
        github: 'fab fa-github',
        linkedin: 'fab fa-linkedin',
        behance: 'fab fa-behance',
        dribbble: 'fab fa-dribbble',
        twitter: 'fab fa-twitter',
        instagram: 'fab fa-instagram',
        youtube: 'fab fa-youtube',
        facebook: 'fab fa-facebook',
        other: 'fas fa-link'
    };

    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('social-links-wrapper');
        const addBtn = document.getElementById('add-social');
        const template = document.getElementById('social-link-template').content;

        addBtn.addEventListener('click', () => {
            const index = wrapper.querySelectorAll('.social-link-group').length;
            const clone = document.importNode(template, true);
            const html = clone.firstElementChild.outerHTML.replace(/__name__/g, `social_links[${index}]`);
            wrapper.insertAdjacentHTML('beforeend', html);
        });

        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('platform-select')) {
                const platform = e.target.value;
                const group = e.target.closest('.social-link-group');
                const iconInput = group.querySelector('.icon-input');
                const iconPreview = group.querySelector('.icon-preview');

                if (iconMap[platform]) {
                    iconInput.value = iconMap[platform];
                    iconPreview.className = 'icon-preview ' + iconMap[platform];
                } else {
                    iconInput.value = '';
                    iconPreview.className = 'icon-preview';
                }
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-social')) {
                e.target.closest('.social-link-group').remove();
            }
        });
    });

    //////////////////////////////////// Project Images ////////////////////////////////////
    document.addEventListener('DOMContentLoaded', function () {
        let imageCounter = document.querySelectorAll('#additional-images .image-group').length + 1;

        // Add new image input
        document.getElementById('addImage').addEventListener('click', function () {
            const container = document.getElementById('additional-images');
            const timestamp = Date.now();

            const newGroup = document.createElement('div');
            newGroup.className = 'image-group';
            newGroup.innerHTML = `
                <div class="input-group">
                    <label>Image ${imageCounter}:</label>
                    <input type="file" name="images[new_${timestamp}]" accept="image/*">
                    <button type="button" class="btn-danger remove-image">
                        <i class="uil uil-trash-alt"></i>
                    </button>
                </div>
            `;
            container.appendChild(newGroup);
            imageCounter++;
        });

        // Remove newly added images (event delegation)
        document.getElementById('additional-images').addEventListener('click', function (e) {
            const removeBtn = e.target.closest('.remove-image');
            if (removeBtn) {
                removeBtn.closest('.image-group').remove();
            }
        });

        // Remove existing images and mark for deletion
        document.querySelectorAll('.remove-existing-image').forEach(button => {
            button.addEventListener('click', function () {
                const imageId = this.dataset.id;
                const group = this.closest('.existing-image-group');

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'deleted_images[]';
                input.value = imageId;

                document.getElementById('deleted-images-container').appendChild(input);
                group.remove();
            });
        });
    });


    ////////////////////////////////////////////////////////////////////////

    
//////////////////////////////// Icons ///////////////////////////////////////
// Load icons from the server

//const iconCategories = @json($icons); // Use the passed icons variable

// Initialize variables
let currentCategory = 'all';
let searchTerm = '';

// DOM Elements
const iconModal = document.getElementById('iconModal');
const iconSelector = document.getElementById('iconSelector');
const iconSearch = document.getElementById('iconSearch');
const iconGrid = document.getElementById('iconGrid');
const selectedIconInput = document.getElementById('selectedIcon');
const iconPreview = document.getElementById('iconPreview');
const closeButton = document.querySelector('.btn-close');
const categories = document.querySelectorAll('.sidebar-category');

// Helper function to get all icons
function getAllIcons() {
    const allIcons = [];
    for (const category in iconCategories) {
        allIcons.push(...iconCategories[category]);
    }
    return allIcons;
}

// Filter icons based on search and category
function filterIcons() {
    let icons = [];
    
    if (currentCategory === 'all') {
        icons = getAllIcons();
    } else {
        icons = iconCategories[currentCategory] || [];
    }

    if (searchTerm) {
        icons = icons.filter(icon => 
            icon.toLowerCase().includes(searchTerm.toLowerCase())
        );
    }

    return icons;
}

// Render the icon grid
function renderIcons() {
    const icons = filterIcons();
    iconGrid.innerHTML = icons.map(icon => `
        <div class="icon-item" data-icon="${icon}">
            <i class="${icon}"></i>
            <span class="icon-name">${icon.split(' ')[1].substring(3)}</span>
        </div>
    `).join('');

    // Add click handlers to icon items
    document.querySelectorAll('.icon-item').forEach(item => {
        item.addEventListener('click', () => {
            const icon = item.dataset.icon;
            selectedIconInput.value = icon;
            iconPreview.innerHTML = `<i class="${icon}"></i><span>${icon}</span>`;
            iconPreview.classList.remove('hidden');
            iconModal.classList.remove('active');
        });
    });
}

// Event Listeners
iconSelector.addEventListener('click', () => {
    iconModal.classList.add('active');
    renderIcons();
});

closeButton.addEventListener('click', () => {
    iconModal.classList.remove('active');
});

iconSearch.addEventListener('input', (e) => {
    searchTerm = e.target.value;
    renderIcons();
});

categories.forEach(category => {
    category.addEventListener('click', () => {
        categories.forEach(c => c.classList.remove('active'));
        category.classList.add('active');
        currentCategory = category.dataset.category;
        renderIcons();
    });
});

// Close modal when clicking outside
iconModal.addEventListener('click', (e) => {
    if (e.target === iconModal) {
        iconModal.classList.remove('active');
    }
});

// Initialize
renderIcons();
/////////////////////////////////////////////////////////////////////////////////////////////////////
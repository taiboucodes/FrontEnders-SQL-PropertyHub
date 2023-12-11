const addPropertyBtn = document.getElementById('addPropertyBtn');
const formContainer = document.getElementById('formContainer');
const propertyList = document.getElementById('propertyList');
const form = document.querySelector('form');

addPropertyBtn.addEventListener('click', () => {
    formContainer.style.display = 'block';
    addPropertyBtn.style.display = 'none';
});

function displayProperty() {
    const formData = new FormData(form);

    const modal = document.createElement('div');
    modal.classList.add('modal');

    const modalContent = document.createElement('div');
    modalContent.classList.add('modal-content');
    modalContent.innerHTML = `
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>Property Details</h3>
        <img id="displayedImage" style="max-width: 400px;">
        <p>Location: ${formData.get('location')}</p>
        <p>Age: ${formData.get('age')}</p>
        <p>Square Feet: ${formData.get('sqr_feet')}</p>
        <p>Number of Beds: ${formData.get('num_beds')}</p>
        <p>Number of Bathrooms: ${formData.get('num_bath')}</p>
        <p>Garden: ${formData.get('y_nGarden') === 'on' ? 'Yes' : 'No'}</p>
        <p>Parking: ${formData.get('parking')}</p>
        <p>School Proximity: ${formData.get('school_prox')}</p>
        <p>Main Road Proximity: ${formData.get('mainRoad_prox')}<br><br></p>
    `;


    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('delete-btn');
    deleteButton.addEventListener('click', () => closeModal());

    modalContent.appendChild(deleteButton);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
}


form.addEventListener('submit', function (event) {
     event.preventDefault();
     displayProperty();

    
    const formData = new FormData(form);
    formData.append('submit_property', 'true');

    
    const xhr = new XMLHttpRequest();

   
    xhr.open('POST', 'seller_dash.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');


    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
             
                 formContainer.style.display = 'none';
                 addPropertyBtn.style.display = 'block';
                form.reset();
             
           } else {
                
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

   
     xhr.send(formData);
 });

function goBack() {
    formContainer.style.display = 'none';
    addPropertyBtn.style.display = 'block';
}
function showPropertyDetails(location, sqrFeet, age, numBeds, numBath, garden, parking, schoolProx, mainRoadProx) {

    const modal = document.createElement('div');
    modal.classList.add('modal');
    modal.innerHTML = `
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>${location}</h2>
            <p>Square Feet: ${sqrFeet}</p>
            <p>Age: ${age}</p>
            <p>Number of Beds: ${numBeds}</p>
            <p>Number of Bathrooms: ${numBath}</p>
            <p>Garden: ${garden}</p>
            <p>Parking: ${parking}</p>
            <p>School Proximity: ${schoolProx}</p>
            <p>Main Road Proximity: ${mainRoadProx}</p>
        </div>
    `;

    document.body.appendChild(modal);
    modal.style.display = 'block';
}


function closeModal() {
    const modal = document.querySelector('.modal');
    modal.parentNode.removeChild(modal);
}
function deleteProperty(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const cardToRemove = document.getElementById(`card_${id}`);
                cardToRemove.remove();
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };
    xhr.send(`id=${id}`);
    alert("Property successfully deleted!");
    location.reload();
}

function addProperty() {
    const form = document.getElementById('propertyForm');

   
    const formData = new FormData(form);

   
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'add.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

   
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert("Property successfully added!");
                location.reload();

                const formContainer = document.getElementById('formContainer');
                const addPropertyBtn = document.getElementById('addPropertyBtn');
                formContainer.style.display = 'none';
                addPropertyBtn.style.display = 'block';

              
                form.reset();
            } else {
               
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    xhr.send(formData);
}
function editProperty(location, age, sqrFeet, numBeds, numBath, y_nGarden, parking, schoolProx, mainRoadProx) {
    const form = document.getElementById('propertyForm');
    form.location.value = location;
    form.age.value = age;
    form.sqr_feet.value = sqrFeet;
    form.num_beds.value = numBeds;
    form.num_bath.value = numBath;
    form.y_nGarden.checked = y_nGarden === 'on'; // Check the checkbox based on the value
    form.parking.value = parking;
    form.school_prox.value = schoolProx;
    form.mainRoad_prox.value = mainRoadProx;

    const formContainer = document.getElementById('formContainer');
    const addPropertyBtn = document.getElementById('addPropertyBtn');
    formContainer.style.display = 'block';
    addPropertyBtn.style.display = 'none';
}
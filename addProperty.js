const addPropertyBtn = document.getElementById('addPropertyBtn');
const formContainer = document.getElementById('formContainer');
const propertyList = document.getElementById('propertyList');

addPropertyBtn.addEventListener('click', function() {
    formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
    addPropertyBtn.style.display = 'none';
});

function displayProperty() {
    const location = document.getElementsByName('location')[0].value;
    const age = document.getElementsByName('age')[0].value;
    const sqrFeet = document.getElementsByName('sqr_feet')[0].value;
    const numBeds = document.getElementsByName('num_beds')[0].value;
    const numBath = document.getElementsByName('num_bath')[0].value;
    const garden = document.getElementsByName('y_nGarden')[0].value;
    const parking = document.getElementsByName('parking')[0].value;
    const schoolProx = document.getElementsByName('school_prox')[0].value;
    const mainRoadProx = document.getElementsByName('mainRoad_prox')[0].value;

    const propertyCard = document.createElement('div');
    propertyCard.classList.add('card');
    propertyCard.innerHTML = `
        <h3>Property Details</h3>
        <p>Location: ${location}</p>
        <p>Age: ${age}</p>
        <p>Square Feet: ${sqrFeet}</p>
        <p>Number of Beds: ${numBeds}</p>
        <p>Number of Bathrooms: ${numBath}</p>
        <p>Garden: ${garden}</p>
        <p>Parking: ${parking}</p>
        <p>School Proximity: ${schoolProx}</p>
        <p>Main Road Proximity: ${mainRoadProx}<br><br></p>
    `;
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('delete-btn');
    deleteButton.addEventListener('click', function() {
        propertyCard.remove();
    });
    
    propertyCard.appendChild(deleteButton);
    propertyList.appendChild(propertyCard);
}

const form = document.querySelector('form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    displayProperty();
    formContainer.style.display = 'none';
    addPropertyBtn.style.display = 'block';
    form.reset();
});

function goBack() {
    formContainer.style.display = 'none';
    addPropertyBtn.style.display = 'block';
}

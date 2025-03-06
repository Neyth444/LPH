document.addEventListener('DOMContentLoaded', () => {

    // Slider dynamique pour les menus
    const slider = document.querySelector('.menu-slider');
    const leftBtn = document.querySelector('.left-btn');
    const rightBtn = document.querySelector('.right-btn');
    const menuCards = document.querySelectorAll('.menu-card');
    const menuDetails = document.getElementById('menu-details');
    const menuTitle = document.getElementById('menu-title');
    const menuItems = document.getElementById('menu-items');
    let currentIndex = 0;

    const menus = {
        classique: [
            "Poulet frit classique",
            "Frites maison",
            "Sauce barbecue",
            "Walter White Juice",
            "12.90€"
        ],
        epice: [
            "Poulet frit épicé",
            "Frites épicées maison",
            "Sauce piquante maison",
            "Jesse Juice",
            "14.90€"
        ],
        famille: [
            "Bucket familial de poulet frit",
            "Grande portion de frites",
            "Assortiment de sauces",
            "4 boissons au choix",
            "Dessert familial",
            "24.90€"
        ],
        gus: [
            "Poulet gourmet signature Gus",
            "Pommes de terre au four",
            "Sauce spéciale Gustavo",
            "Gustavo Juice",
            "19.90€"
        ],
        vegan: [
            "Burger steak de soja",
            "Frites maison",
            "Sauce pommes frites",
            "Skyler Juice",
            "14.90€"
        ]
        
    };

    // Fonction mise à jour position slider
    function updateSliderPosition() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    leftBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + menuCards.length) % menuCards.length;
        updateSliderPosition();
    });

    rightBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % menuCards.length;
        updateSliderPosition();
    });

    updateSliderPosition();

    menuCards.forEach(card => {
        card.addEventListener('click', () => {
            const menuKey = card.getAttribute('data-menu');
            menuTitle.textContent = ""; // Retire le titre
            menuItems.innerHTML = "";
    
            menus[menuKey].slice(0, -1).forEach(item => {
                const li = document.createElement('li');
                li.textContent = item;
                menuItems.appendChild(li);
            });
    
            const prix = menus[menuKey][menus[menuKey].length - 1];
            const prixItem = document.createElement('li');
            prixItem.innerHTML = `<strong>Prix : ${prix}</strong>`;
            prixItem.style.listStyle = "none"; // Sans point noir
            menuItems.appendChild(prixItem);
    
            menuDetails.classList.remove('hidden');
            menuDetails.scrollIntoView({ behavior: 'smooth' });
        });
    });
    

    // Formulaire de réservation dynamique avec validation
    const reservationForm = document.getElementById('reservation-form');

    reservationForm.addEventListener('submit', function(e){
        e.preventDefault();

        const nom = document.getElementById('nom').value;
        const email = document.getElementById('email').value;
        const dateReservation = document.getElementById('date-reservation').value;
        const service = document.getElementById('service').value;

        if (!nom || !email || !dateReservation || !service) {
            alert("Veuillez remplir tous les champs !");
            return;
        }

        const today = new Date().toISOString().split('T')[0];
        if (dateReservation < today) {
            alert("La réservation pour une date passée n’est pas possible.");
            return;
        }

        alert(`Merci ${nom}, votre réservation pour le ${dateReservation} (${service}) a été enregistrée.`);

        // Envoi effectif du formulaire après validation
        reservationForm.submit();
    });

});

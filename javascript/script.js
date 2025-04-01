document.addEventListener('DOMContentLoaded', () => {
    let menus = {};
    let menuKeys = [];
    let currentIndex = 0;

    const slider = document.querySelector('.menu-slider');
    const menuDetails = document.getElementById('menu-details');
    const menuTitle = document.getElementById('menu-title');
    const menuItems = document.getElementById('menu-items');

    // Charger les menus dynamiquement depuis la base de données
    fetch('api/get_menus.php')
        .then(res => res.json())
        .then(data => {
            data.forEach((menu) => {
                const key = menu.nom.toLowerCase().replace(/\s+/g, '_');
                menus[key] = {
                    nom: menu.nom,
                    description: menu.description,
                    prix: menu.prix + "€",
                    items: menu.items
                };
                menuKeys.push(key);

                const card = document.createElement('div');
                card.className = 'menu-card';
                card.dataset.menu = key;
                card.textContent = menu.nom;
                slider.appendChild(card);
            });

            updateSliderPosition(); //  premier menu par défaut
        });

    function afficherMenu(menuKey) {
        const menu = menus[menuKey];
        menuTitle.textContent = menu.nom;
        menuItems.innerHTML = "";

        menu.items.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item;
            menuItems.appendChild(li);
        });

        const prixItem = document.createElement('li');
        prixItem.innerHTML = `<strong>Prix : ${menu.prix}</strong>`;
        prixItem.style.listStyle = "none";
        menuItems.appendChild(prixItem);

        let descriptionElement = document.getElementById('menu-description');
        if (!descriptionElement) {
            descriptionElement = document.createElement('p');
            descriptionElement.id = "menu-description";
            descriptionElement.style.marginTop = "10px";
            descriptionElement.style.fontStyle = "italic";
            descriptionElement.style.color = "#555";
            menuDetails.appendChild(descriptionElement);
        }
        descriptionElement.textContent = menu.description;

        menuDetails.classList.remove('hidden');
    }

    function updateSliderPosition() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        afficherMenu(menuKeys[currentIndex]);
    }

    document.querySelector('.left-btn').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + menuKeys.length) % menuKeys.length;
        updateSliderPosition();
    });

    document.querySelector('.right-btn').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % menuKeys.length;
        updateSliderPosition();
    });

    // ==== FORMULAIRE DE RÉSERVATION ====
    const reservationForm = document.getElementById('reservation-form');

    const messageBox = document.createElement('div');
    messageBox.id = "reservation-message";
    messageBox.style.marginTop = "15px";
    messageBox.style.padding = "10px";
    messageBox.style.borderRadius = "5px";
    messageBox.style.display = "none";
    reservationForm.appendChild(messageBox);

    reservationForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const nom = document.getElementById('nom').value;
        const email = document.getElementById('email').value;
        const dateReservation = document.getElementById('date-reservation').value;
        const service = document.getElementById('service').value;
        const today = new Date().toISOString().split('T')[0];

        if (!nom || !email || !dateReservation || !service) {
            afficherMessage("Veuillez remplir tous les champs.", "error");
            return;
        }

        if (dateReservation < today) {
            afficherMessage("La réservation pour une date passée n’est pas possible.", "error");
            return;
        }

        afficherMessage(`Merci ${nom}, votre réservation pour le ${dateReservation} (${service}) a été enregistrée.`, "success");
        reservationForm.submit();
    });

    function afficherMessage(message, type) {
        messageBox.textContent = message;
        messageBox.style.display = "block";
        if (type === "success") {
            messageBox.style.backgroundColor = "#d4edda";
            messageBox.style.color = "#155724";
            messageBox.style.border = "1px solid #c3e6cb";
        } else {
            messageBox.style.backgroundColor = "#f8d7da";
            messageBox.style.color = "#721c24";
            messageBox.style.border = "1px solid #f5c6cb";
        }
    }
});


    fetch('header.html')
        .then(res => res.text())
        .then(data => {
            document.getElementById('include-header').innerHTML = data;
        });


    fetch('presentation.html')
        .then(res => res.text())
        .then(data => {
            document.getElementById('include-presentation').innerHTML = data;
        });

    fetch('menu.html')
        .then(res => res.text())
        .then(data => {
            document.getElementById('include-menu').innerHTML = data;
        });

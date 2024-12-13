<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MG's Portfolio</title>

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            overflow: hidden;
            background: url('bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logo {
            max-width: 600px;
            width: 80%;
            height: auto;
            opacity: 0;
            animation: fadeInMoveUp 3s forwards;
        }

        @keyframes fadeInMoveUp {
            0% { opacity: 0; transform: translateY(50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        #content {
            display: none;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .category {
            margin-bottom: 40px;
        }

        .category-title {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            text-transform: uppercase;
        }

        .card-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }

        .card:hover { transform: scale(1.05); }

        .card img { width: 100%; height: 200px; object-fit: cover; }

        .card-body { padding: 20px; text-align: center; }

        .card-title { font-size: 1.5rem; margin: 10px 0; color: #333; }

        .card-description { font-size: 1rem; color: #777; margin-bottom: 15px; }

        .side-panel {
            position: fixed;
            right: -100%;
            top: 0;
            width: 400px;
            height: 100%;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            padding: 20px;
            overflow-y: auto;
            z-index: 1001;
        }

        .side-panel.open {
            right: 0;
        }

        .side-panel-content {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .side-panel-content.visible {
            opacity: 1;
        }

        .side-panel img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .side-panel h2 {
            margin-top: 0;
            font-size: 2rem;
            color: #333;
        }

        .side-panel p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 1rem;
        }

        .view-project-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Dark Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            display: none;
        }

        .overlay.visible {
            display: block;
        }
    </style>
</head>
<body>

    <div class="logo-container">
        <img src="name.png" alt="Fionna's Portfolio" class="logo" />
    </div>

    <div id="content"></div>

    <!-- Dark Overlay -->
    <div class="overlay" id="overlay" onclick="closePanel()"></div>

    <!-- Side Panel -->
    <div class="side-panel" id="sidePanel">
        <button class="close-btn" onclick="closePanel()">Close</button>
        <div class="side-panel-content" id="sidePanelContent">
            <img id="panelImage" src="" alt="Project Image">
            <h2 id="panelTitle"></h2>
            <p id="panelDescription"></p>
            <a href="#" id="viewProjectBtn" class="view-project-btn" target="_blank">View Project</a>
        </div>
    </div>

    <script>
        const categories = [
            {
                title: "Website Projects",
                products: [
                    {
                        name: "Business Website for BFFVARNBREAD",
                        description: "A modern business website.",
                        detailedDescription: "A full-featured realty website with responsive design and inventory and record integration.",
                        image: "Images/bff.jpg",
                        link: "Web Projects/bff.php"
                    },
                    {
                        name: "Filasia Platform",
                        description: "Interactive platform for Filasia.",
                        detailedDescription: "Created a dynamic platform with user login, data analytics, and rich interactive elements for Filasia.",
                        image: "https://via.placeholder.com/300x200",
                        link: "https://example.com/bffvarnbread"

                    },
                    {
                        name: "Inventory Management System for LionsTech",
                        description: "some other information",
                        detailedDescription: "Click to view more",
                        image: "https://via.placeholder.com/300x200",
                        link: "https://example.com/bffvarnbread"

                    },
                    {
                        name: "Learning Website",
                        description: "some other information",
                        detailedDescription: "Click to view more",
                        image: "https://via.placeholder.com/300x200",
                        link: "https://example.com/bffvarnbread"

                    }
                    
                ]
            },
            {
                title: "Android Projects",
                products: [
                    {
                        name: "MIRA Translator App",
                        description: "Sign language translation app.",
                        detailedDescription: "An AI-powered mobile application that translates sign language into text and speech in real-time.",
                        image: "https://via.placeholder.com/300x200",
                        link: "https://example.com/bffvarnbread"

                    },
                    {
                        name: "ARVenture Game",
                        description: "Augmented reality adventure game.",
                        detailedDescription: "Developed an engaging augmented reality game combining real-world exploration with digital challenges.",
                        image: "https://via.placeholder.com/300x200",
                        link: "https://example.com/bffvarnbread"

                    },
                    {
                        name: "OMRScanner",
                        description: "some other information",
                        detailedDescription: "Click to view more",
                        image: "https://via.placeholder.com/300x200",
                        link: "https://example.com/bffvarnbread"

                    },
                    
                    {
                        name: "AmpingPahiyom",
                        description: "some other information",
                        detailedDescription: "Click to view more",
                        image: "https://via.placeholder.com/300x200",
                        link: "https://example.com/bffvarnbread"

                    }
                ]
            }
        ];

        function createCard(product) {
            const card = document.createElement('div');
            card.classList.add('card');
            card.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <div class="card-body">
                    <h2 class="card-title">${product.name}</h2>
                    <p class="card-description">${product.description}</p>
                </div>
            `;
            card.addEventListener('click', () => openPanel(product));
            return card;
        }

        function createCategory(category) {
            const categoryDiv = document.createElement('div');
            categoryDiv.classList.add('category');
            categoryDiv.innerHTML = `<h2 class="category-title">${category.title}</h2>`;

            const cardContainer = document.createElement('div');
            cardContainer.classList.add('card-container');
            category.products.forEach(product => {
                cardContainer.appendChild(createCard(product));
            });

            categoryDiv.appendChild(cardContainer);
            return categoryDiv;
        }

        function renderCategories() {
            const content = document.getElementById('content');
            categories.forEach(category => {
                content.appendChild(createCategory(category));
            });
        }

        function openPanel(product) {
            document.getElementById('panelImage').src = product.image;
            document.getElementById('panelTitle').textContent = product.name;
            document.getElementById('panelDescription').textContent = product.detailedDescription;
            document.getElementById('viewProjectBtn').href = product.link;

            document.getElementById('sidePanel').classList.add('open');
            document.getElementById('overlay').classList.add('visible');
            document.getElementById('sidePanelContent').classList.add('visible');
        }

        function closePanel() {
            document.getElementById('sidePanel').classList.remove('open');
            document.getElementById('overlay').classList.remove('visible');
            document.getElementById('sidePanelContent').classList.remove('visible');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const logoContainer = document.querySelector('.logo-container');
            const content = document.getElementById('content');

            logoContainer.addEventListener('animationend', function () {
                renderCategories();
                content.style.display = 'block';
                document.body.style.overflow = 'auto';
            });
        });
    </script>

</body>
</html>

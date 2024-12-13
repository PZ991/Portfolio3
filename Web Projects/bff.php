<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modular Sidebar with Card Preview</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
      :root {
            --primary-color: #007BFF;
            --secondary-color: #6c757d;
            --background-light: #f8f9fa;
            --background-dark: #343a40;
            --text-color: #212529;
            --border-radius: 12px;
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            width: 100%;
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
        }

        #app {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 280px;
            background-color: var(--background-dark);
            color: white;
            height: 100vh;
            overflow-y: auto;
            padding: 20px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            transition: width var(--transition-speed);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar li {
            padding: 12px 15px;
            cursor: pointer;
            border-radius: var(--border-radius);
            transition: background-color var(--transition-speed);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nested {
            display: none;
            padding-left: 15px;
            margin-top: 5px;
        }

        .sidebar .expandable::after {
            content: '▶';
            font-size: 0.8em;
            margin-left: 10px;
            transition: transform var(--transition-speed);
        }

        .sidebar .expanded::after {
            transform: rotate(90deg);
        }

        .main-content {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
        }

        .content {
            width: 60%;
            padding: 30px;
            background-color: var(--background-light);
            overflow-y: auto;
        }

        .section {
            margin-bottom: 40px;
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background-color: white;
            border: 1px solid #e9ecef;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all var(--transition-speed);
            padding: 20px;
            gap: 20px;
            width: 90%; 
        }

        .card:hover {
            transform: translateX(10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        }

        .card img {
            width: 150px; 
            height: 150px;
            object-fit: cover;
            border-radius: var(--border-radius);
        }

        .card-content {
            flex-grow: 1;
        }

        .card-content h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .card-content p {
            color: var(--secondary-color);
        }

        .preview-panel {
            width: 40%;
            padding: 30px;
            background-color: white;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.05);
        }

        .preview-panel img {
            max-width: 100%;
            max-height: 60%;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .preview-details {
            font-size: 1rem;
            color: var(--secondary-color);
            max-width: 90%;
        }

        @media (max-width: 1024px) {
            .main-content {
                flex-direction: column;
            }

            .content, .preview-panel {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div id="app"></div>
    <script type="module">
        // Data Module
        const siteData = {
            sections: [
                {
                    id: 'section1',
                    title: 'Home Menu',
                    items: [
                        {
                            title: 'Home',
                            contents: [
                                {
                                    title: 'Page 1',
                                    description: 'Details about Page 1.',
                                    imageSrc: 'https://via.placeholder.com/300x150',
                                    previewImage: 'https://via.placeholder.com/600x400',
                                    previewDetails: 'This is a detailed description for Page 1.'
                                }
                            ]
                        }
                    ]
                },
                {
                    id: 'section2',
                    title: 'BFF',
                    items: [
                        {
                            title: 'BFF Home',
                            contents: [
                                {
                                    title: 'Dashboard',
                                    description: 'Details about Page 1.',
                                    imageSrc: 'https://via.placeholder.com/300x150',
                                    previewImage: 'https://via.placeholder.com/600x400',
                                    previewDetails: 'This is a detailed description for Page 1.'
                                }
                            ]
                        },
                        {
                            title: 'Finance',
                            contents: [
                                {
                                    title: 'DCR',
                                    description: 'Details about Page 2.',
                                    imageSrc: 'https://via.placeholder.com/300x150',
                                    previewImage: 'https://via.placeholder.com/600x400',
                                    previewDetails: 'This is a detailed description for Page 2.'
                                },
                                {
                                    title: 'SOA',
                                    description: 'Details about Page 3.',
                                    imageSrc: 'https://via.placeholder.com/300x150',
                                    previewImage: 'https://via.placeholder.com/600x400',
                                    previewDetails: 'This is a detailed description for Page 3.'
                                }
                            ]
                        }
                    ]
                }
            ]
        };

        // Sidebar Module
        class SidebarModule {
            constructor(data) {
                this.data = data;
            }

            createSidebar() {
                const sidebar = document.createElement('div');
                sidebar.className = 'sidebar';
                sidebar.innerHTML = `
                    <h2>Navigation</h2>
                    <ul id="sidebarMenu"></ul>
                `;

                const sidebarMenu = sidebar.querySelector('#sidebarMenu');
                this.data.sections.forEach(section => {
                    const sectionLi = document.createElement('li');
                    sectionLi.className = 'expandable';
                    sectionLi.textContent = section.title;

                    const nestedUl = document.createElement('ul');
                    nestedUl.className = 'nested';

                    section.items.forEach(item => {
                        const itemLi = document.createElement('li');
                        itemLi.textContent = item.title;
                        // Pass the section id when navigating
                        itemLi.onclick = () => this.navigateTo(section.id);
                        nestedUl.appendChild(itemLi);
                    });

                    sectionLi.appendChild(nestedUl);
                    sidebarMenu.appendChild(sectionLi);
                });

                this.attachSidebarEventListeners(sidebar);
                return sidebar;
            }

            attachSidebarEventListeners(sidebarElement) {
                sidebarElement.querySelectorAll('.expandable').forEach(item => {
                    item.addEventListener('click', (event) => {
                        // Prevent this click from triggering navigation if clicking on section header
                        if (event.target === item) {
                            item.classList.toggle('expanded');
                            const nestedMenu = item.querySelector('.nested');
                            nestedMenu.style.display = nestedMenu.style.display === 'block' ? 'none' : 'block';
                        }
                    });
                });
            }

            navigateTo(sectionId) {
                const contentSection = document.querySelector('.content');
                const section = contentSection.querySelector(`#${sectionId}`);
                
                if (section) {
                    // Scroll the content section to the target section
                    contentSection.scrollTo({
                        top: section.offsetTop - contentSection.offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        }

        // Content Module
        class ContentModule {
            constructor(data) {
                this.data = data;
            }

            createContent() {
                const mainContent = document.createElement('div');
                mainContent.className = 'main-content';

                const contentSection = document.createElement('div');
                contentSection.className = 'content';

                this.data.sections.forEach(section => {
                    section.items.forEach(item => {
                        const sectionDiv = document.createElement('div');
                        sectionDiv.id = section.id;
                        sectionDiv.className = 'section';

                        const sectionTitle = document.createElement('h2');
                        sectionTitle.className = 'section-title';
                        sectionTitle.textContent = `${section.title}: ${item.title}`;
                        sectionDiv.appendChild(sectionTitle);

                        const cardContainer = document.createElement('div');
                        cardContainer.className = 'card-container';

                        item.contents.forEach(content => {
                            const card = this.createCard(content);
                            cardContainer.appendChild(card);
                        });

                        sectionDiv.appendChild(cardContainer);
                        contentSection.appendChild(sectionDiv);
                    });
                });

                const previewPanel = this.createPreviewPanel();
                mainContent.appendChild(contentSection);
                mainContent.appendChild(previewPanel);

                return mainContent;
            }

            createCard(content) {
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
                    <img src="${content.imageSrc}" alt="${content.title}">
                    <div class="card-content">
                        <h3>${content.title}</h3>
                        <p>${content.description}</p>
                    </div>
                `;
                card.onclick = () => this.showPreview(content.previewImage, content.previewDetails);
                return card;
            }

            createPreviewPanel() {
                const previewPanel = document.createElement('div');
                previewPanel.className = 'preview-panel';
                previewPanel.innerHTML = `
                    <img id="previewImage" src="" alt="Preview Image" style="display: none;">
                    <p id="previewDetails" class="preview-details"></p>
                `;
                return previewPanel;
            }

            showPreview(imageSrc, details) {
                const previewPanel = document.querySelector('.preview-panel');
                const previewImage = document.getElementById('previewImage');
                const previewDetails = document.getElementById('previewDetails');
                
                // Show preview panel
                previewPanel.style.display = 'flex';
                
                previewImage.src = imageSrc;
                previewImage.style.display = 'block';
                previewDetails.textContent = details;
            }
        }

        // App Module
        class App {
            constructor(data) {
                this.data = data;
                this.init();
            }

            init() {
                const app = document.getElementById('app');
                const sidebar = new SidebarModule(this.data).createSidebar();
                const content = new ContentModule(this.data).createContent();

                app.appendChild(sidebar);
                app.appendChild(content);
            }
        }

        // Initialize the application
        new App(siteData);
    </script>
</body>
</html>
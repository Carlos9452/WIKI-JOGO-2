document.addEventListener('DOMContentLoaded', function() {
    // Dark mode invertido -> Tema padrão escuro
    const darkModeToggle = document.createElement('button');
    darkModeToggle.id = 'darkModeToggle';
    darkModeToggle.textContent = '☀️'; // ícone de “claro” inicialmente
    darkModeToggle.style.position = 'fixed';
    darkModeToggle.style.bottom = '60px';
    darkModeToggle.style.right = '20px';
    darkModeToggle.style.zIndex = '1000';
    darkModeToggle.style.borderRadius = '50%';
    darkModeToggle.style.width = '40px';
    darkModeToggle.style.height = '40px';
    darkModeToggle.style.border = 'none';
    darkModeToggle.style.cursor = 'pointer';
    darkModeToggle.style.fontSize = '20px';
    document.body.appendChild(darkModeToggle);

    // Aplicar tema escuro padrão
    document.body.classList.add('dark-mode');
    localStorage.setItem('darkMode', 'true');

    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDark);
        darkModeToggle.textContent = isDark ? '☀️' : '🌙'; // troca ícone
    });

    // Recupera preferência no carregamento
    if (localStorage.getItem('darkMode') === 'false') {
        document.body.classList.remove('dark-mode');
        darkModeToggle.textContent = '🌙';
    }

    // Estilos invertidos: tema padrão escuro
    const style = document.createElement('style');
    style.textContent = `
        body.dark-mode {
            background-color: #1a1a1a;
            color: #f0f0f0;
        }
        body.dark-mode header, body.dark-mode footer {
            background-color: #0d0d0d;
        }
        body.dark-mode nav ul li a {
            color: #ddd;
        }
        body.dark-mode .highlight {
            background-color: yellow;
            color: black;
        }

        /* Tema claro quando não está dark-mode */
        body {
            background-color: #f0f0f0;
            color: #1a1a1a;
        }
        header, footer {
            background-color: #fff;
        }
        nav ul li a {
            color: #000;
        }
    `;
    document.head.appendChild(style);
});

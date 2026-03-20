document.addEventListener('DOMContentLoaded', onLoad);

function onLoad() {
    scrollActiveMenuIntoView();
    initIntersectionObserver();
    initAlgoliaSearch();
    initImageZoom();
}

/**
 * Прокрутка активного пункта меню, если он выходит за пределы контейнера
 */
function scrollActiveMenuIntoView() {
    if (window.location.hash) {
        return;
    }

    const nav = document.querySelector('.nav-docs');

    if (!nav || nav.scrollWidth <= nav.clientWidth) {
        return;
    }

    const activeItem = document.querySelector('.active-doc-menu');

    activeItem?.scrollIntoView({
        behavior: 'smooth',
        block: 'end',
        inline: 'center',
    });
}

/**
 * Инициализация IntersectionObserver для анимаций появления
 */
function initIntersectionObserver() {
    const elements = document.querySelectorAll('.intersection');

    if (!elements.length) {
        return;
    }

    const observer = new IntersectionObserver(handleIntersection);

    elements.forEach(element => observer.observe(element));
}

function handleIntersection(entries) {
    entries.forEach(entry => {
        entry.target.classList.toggle('show', entry.isIntersecting);
    });
}

/**
 * Увеличение изображений по клику (lightbox)
 */
function initImageZoom() {
    const images = document.querySelectorAll('.documentation main img');

    images.forEach(image => {
        image.addEventListener('click', () => openImageOverlay(image.src));
    });
}

function openImageOverlay(src) {
    const overlay = document.createElement('div');

    overlay.style.cssText = `
        position: fixed;
        inset: 0;
        z-index: 10000;
        cursor: zoom-out;
        background: rgba(0, 0, 0, 0.5) url('${src}') no-repeat center;
        background-size: contain;
    `;

    overlay.addEventListener('click', () => overlay.remove());

    document.body.appendChild(overlay);
}

/**
 * Инициализация Algolia поиска
 */
function initAlgoliaSearch() {
    const container = document.getElementById('docsearch');

    if (!container) {
        return;
    }

    window.docsearch({
        container: '#docsearch',
        appId: 'WEIYZINI7T',
        apiKey: '9be258641d8c46c9fcc1482b3d4375a2',
        indexName: 'orchid_software',
        searchParameters: {
            facetFilters: [`lang:${document.documentElement.lang}`],
        },
    });
}


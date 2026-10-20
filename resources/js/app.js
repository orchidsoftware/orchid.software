import docsearch from '@docsearch/js/docsearch';

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

function scrollActiveMenuIntoView() {
    if (window.location.hash) {
        return;
    }

    const menu = document.querySelector('.documentation .docs-menu');
    const active = menu?.querySelector('[aria-current="page"]');

    if (active && menu.scrollWidth > menu.clientWidth) {
        active.scrollIntoView({
            behavior: reducedMotion.matches ? 'instant' : 'smooth',
            block: 'nearest',
            inline: 'center',
        });
    }
}

function openImageDialog(image) {
    const dialog = document.createElement('dialog');
    dialog.className = 'lightbox';
    dialog.setAttribute('aria-label', image.alt || 'Image preview');

    const preview = document.createElement('img');
    preview.className = 'image';
    preview.src = image.currentSrc || image.src;
    preview.alt = image.alt;

    const close = document.createElement('button');
    close.type = 'button';
    close.className = 'close';
    close.textContent = '×';
    close.setAttribute('aria-label', 'Close image preview');
    close.addEventListener('click', () => dialog.close());

    dialog.append(close, preview);
    dialog.addEventListener('click', event => {
        if (event.target === dialog) {
            dialog.close();
        }
    });
    dialog.addEventListener('close', () => dialog.remove(), { once: true });
    document.body.append(dialog);
    dialog.showModal();
}

function initImageZoom() {
    for (const image of document.querySelectorAll('.article img')) {
        if (image.closest('a')) {
            continue;
        }

        image.classList.add('docs-image-zoom');
        image.tabIndex = 0;
        image.setAttribute('role', 'button');
        image.setAttribute('aria-haspopup', 'dialog');
        image.setAttribute('aria-label', image.alt ? `Enlarge ${image.alt}` : 'Enlarge image');
        image.addEventListener('click', () => openImageDialog(image));
        image.addEventListener('keydown', event => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openImageDialog(image);
            }
        });
    }
}

function initSearch() {
    if (!document.getElementById('docsearch')) {
        return;
    }

    docsearch({
        container: '#docsearch',
        appId: 'WEIYZINI7T',
        apiKey: '9be258641d8c46c9fcc1482b3d4375a2',
        indices: [{
            name: 'orchid_software',
            searchParameters: {
                facetFilters: [`lang:${document.documentElement.lang}`],
            },
        }],
    });
}

function initDocumentationScrollRegions() {
    const blocks = [...document.querySelectorAll('.article pre, .article table')]
        .filter(block => !block.hasAttribute('tabindex'));

    if (!blocks.length) return;

    const update = block => {
        if (block.scrollWidth > block.clientWidth || block === document.activeElement) {
            block.tabIndex = 0;
        } else {
            block.removeAttribute('tabindex');
        }
    };

    const observer = new ResizeObserver(entries => {
        for (const { target } of entries) update(target);
    });

    for (const block of blocks) {
        update(block);
        observer.observe(block);
        block.addEventListener('blur', () => update(block));
    }
}

scrollActiveMenuIntoView();
initImageZoom();
initSearch();
initDocumentationScrollRegions();

for (const output of document.querySelectorAll('[data-token-value]')) {
    output.textContent = getComputedStyle(output).getPropertyValue(output.dataset.tokenValue).trim();
}

function initCatalogNavigation() {
    const navigation = document.querySelector('[data-catalog-nav]');

    if (!navigation) {
        return;
    }

    const links = new Map([...navigation.querySelectorAll('a[href^="#"]')].map(link => [link.hash.slice(1), link]));
    const entries = [...document.querySelectorAll('main section[id]')]
        .filter(section => links.has(section.id))
        .map(section => ({ section, link: links.get(section.id) }));
    let activeLink;
    let frame;

    const update = () => {
        const readingLine = window.innerHeight / 3;
        const atEnd = Math.ceil(window.scrollY + window.innerHeight) >= document.documentElement.scrollHeight;
        const current = atEnd ? entries.at(-1) : entries.findLast(({ section }) => section.getBoundingClientRect().top <= readingLine) ?? entries[0];

        if (current.link === activeLink) {
            return;
        }

        activeLink?.removeAttribute('aria-current');
        activeLink = current.link;
        activeLink.setAttribute('aria-current', 'location');

        if (navigation.scrollWidth > navigation.clientWidth) {
            navigation.scrollTo({
                left: navigation.scrollLeft + activeLink.getBoundingClientRect().left - navigation.getBoundingClientRect().left - (navigation.clientWidth - activeLink.offsetWidth) / 2,
                behavior: reducedMotion.matches ? 'instant' : 'smooth',
            });
        }
    };

    window.addEventListener('scroll', () => {
        cancelAnimationFrame(frame);
        frame = requestAnimationFrame(update);
    }, { passive: true });
    window.addEventListener('resize', update);
    update();
}

function updateCatalogTypeMetrics() {
    for (const output of document.querySelectorAll('[data-type-metric]')) {
        const sample = document.getElementById(output.dataset.typeMetric);
        const style = getComputedStyle(sample);
        const size = Number(parseFloat(style.fontSize).toFixed(2));
        const leading = Number(parseFloat(style.lineHeight).toFixed(2));
        output.textContent = `${size} / ${leading}\u00a0px`;
    }
}

initCatalogNavigation();
updateCatalogTypeMetrics();
window.addEventListener('resize', updateCatalogTypeMetrics);

function updatePaletteContrast() {
    const outputs = document.querySelectorAll('[data-palette-contrast]');
    if (!outputs.length) return;

    const canvas = document.createElement('canvas');
    canvas.width = canvas.height = 1;
    const context = canvas.getContext('2d', { willReadFrequently: true });
    if (!context) return;

    const luminance = channels => {
        const linear = [...channels].slice(0, 3).map(value => {
            const channel = value / 255;
            return channel <= .04045 ? channel / 12.92 : ((channel + .055) / 1.055) ** 2.4;
        });
        return linear[0] * .2126 + linear[1] * .7152 + linear[2] * .0722;
    };

    for (const output of outputs) {
        const palette = output.closest('.palette');
        const sample = output.closest('.contrast-pair').querySelector('.contrast-text');
        context.clearRect(0, 0, 1, 1);
        context.fillStyle = getComputedStyle(palette).backgroundColor;
        context.fillRect(0, 0, 1, 1);
        const background = luminance(context.getImageData(0, 0, 1, 1).data);
        context.fillStyle = getComputedStyle(sample).color;
        context.fillRect(0, 0, 1, 1);
        const foreground = luminance(context.getImageData(0, 0, 1, 1).data);
        const ratio = (Math.max(foreground, background) + .05) / (Math.min(foreground, background) + .05);
        output.textContent = `${(Math.floor(ratio * 100) / 100).toFixed(2).replace('.', ',')}:1`;
    }
}

updatePaletteContrast();
window.matchMedia('(forced-colors: active)').addEventListener('change', updatePaletteContrast);

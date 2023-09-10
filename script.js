function showProductInfo(productName) {
    alert(`Detalhes sobre: ${productName}`);
}

document.getElementById('menu').addEventListener('click', function(event) {
    if (event.target.tagName === 'A') {
        alert(`Você clicou no menu: ${event.target.innerText}`);
    }
});

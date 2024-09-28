
class ProductTable
{
    constructor() {
        this.url = window.loadProductUrl;
        this.container = document.getElementById('table-container');
        this.template = document.getElementById('table-template');
        this.data = null;
    }

    init() {
        this.loadData().then(() => this.showTable());
    }

    showTable() {
        this.data.forEach((product) => {
            const clone = this.template.content.cloneNode(true);
            clone.querySelectorAll('.product-id')[0].textContent = product.id;
            clone.querySelectorAll('.product-name')[0].textContent = product.name;
            clone.querySelectorAll('.product-description')[0].textContent = product.description;
            clone.querySelectorAll('.product-image img')[0].setAttribute('src', product.image);
            clone.querySelectorAll('.product-action-view')[0].setAttribute('href', product.viewUrl);
            clone.querySelectorAll('.product-action-delete')[0]?.setAttribute('href', product.deleteUrl);

            this.container.append(clone);
        });
    }

    async loadData() {
        try {
            const response = await fetch(this.url);

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            const json = await response.json();
            this.data = json.data;
        } catch (e) {
            console.log(e.message)
        }
    }
}

(() => {
    const table = new ProductTable();
    table.init();
})();
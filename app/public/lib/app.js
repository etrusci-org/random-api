"use strict";
const APP = {
    conf: {
        apiEndpointPath: './api.php?r=',
    },
    ui: {
        main: document.querySelector('main'),
        errors: document.querySelector('.errors'),
        randomItemValue: document.querySelector('.random-item-value'),
        randomItemInfo: document.querySelector('.random-item-info'),
    },
    main() {
        if (!this.ui.main) {
            return;
        }
        this.ui.main.addEventListener('click', (event) => {
            event.preventDefault();
            this.refreshRandomItem();
        });
        this.ui.main.style.display = 'flex';
        this.refreshRandomItem();
    },
    refreshRandomItem() {
        if (this.ui.errors) {
            this.ui.errors.innerHTML = '';
            this.ui.errors.style.display = 'none';
        }
        fetch(this.conf.apiEndpointPath)
            .then(response => {
            if (!response.ok) {
                throw new Error('API network response was not OK.');
            }
            return response.json();
        })
            .then(response => {
            if (response.errors.length > 0) {
                console.error('API respone errors:', response.errors);
                if (this.ui.errors) {
                    this.ui.errors.innerHTML = response.errors.join('<br>');
                    this.ui.errors.style.display = 'block';
                }
                return;
            }
            let request = response.request;
            let val = response.data[0].val;
            if (this.ui.randomItemInfo && this.ui.randomItemValue) {
                this.ui.randomItemValue.innerHTML = val;
                this.ui.randomItemInfo.innerHTML = `&lt;${request}&gt;`;
            }
        })
            .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    },
};

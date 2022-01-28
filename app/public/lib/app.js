export { App };
const App = {
    conf: {
        apiEndpointPath: './api.php',
    },
    ui: {},
    main() {
        this.collectUIElements();
        this.ui['main'].addEventListener('click', () => { this.refreshRandomItem(); });
        this.ui['main'].style.display = 'flex';
        this.refreshRandomItem();
    },
    collectUIElements() {
        let elements = document.querySelectorAll('[data-uikey]');
        elements.forEach(element => {
            if (element instanceof HTMLElement) {
                let uikey = element.dataset['uikey'];
                if (uikey) {
                    element.classList.add('ui', uikey);
                    this.ui[uikey] = element;
                }
            }
        });
    },
    refreshRandomItem() {
        this.ui['errors'].innerHTML = '';
        this.ui['errors'].style.display = 'none';
        this.apiRequest().then((response) => {
            if (!response) {
                return;
            }
            if (response.errors.length > 0) {
                console.error('API respone errors:', response.errors);
                this.ui['errors'].innerHTML = response.errors.join('<br>');
                this.ui['errors'].style.display = 'block';
                return;
            }
            let request = response.request;
            let val = response.data[0].val;
            this.ui['random-item'].innerHTML = val;
            this.ui['random-item-info'].innerHTML = `&lt;${request}&gt;`;
        });
    },
    apiRequest(request = '') {
        const requestData = new FormData();
        requestData.append('r', request);
        return fetch(this.conf.apiEndpointPath, {
            method: 'POST',
            body: requestData,
        })
            .then(response => {
            if (!response.ok) {
                throw new Error('API network response was not OK');
            }
            return response.json();
        })
            .catch(error => {
            console.error('API request error:', error);
            this.ui['errors'].innerHTML = `API error: ${error}`;
        });
    },
};

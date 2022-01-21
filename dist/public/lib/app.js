import { conf } from './conf.js';
export { App };
const App = {
    conf: conf,
    ui: {},
    apiRequest(request) {
        const requestData = new FormData();
        requestData.append('r', request);
        return fetch(this.conf.apiEndpointPath, {
            method: 'POST',
            body: requestData,
        })
            .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not OK');
            }
            return response.json();
        })
            .catch(error => {
            console.error('apiRequest Error:', error);
        });
    },
    collectUIElements() {
        document.querySelectorAll('[data-uikey]').forEach(ele => {
            this.ui[ele.dataset.uikey] = ele;
            ele.classList.add('ui', ele.dataset.uikey);
        });
    },
    main() {
        this.collectUIElements();
        this.ui.randomness.addEventListener('click', () => { this.refreshRandomness(); });
        this.setUIValue('randomness', 'Loading...');
        this.setUIValue('apiEndpointPath', this.conf.apiEndpointPath, true, 'href');
        this.refreshRandomness();
    },
    refreshRandomness() {
        this.setUIValue('errors', '');
        this.apiRequest('').then((response) => {
            if (!response) {
                return;
            }
            if (response.errors.length > 0) {
                this.setUIValue('errors', response.errors.join('<br>'));
                console.error(response.errors);
                return;
            }
            this.setUIValue('randomness', response.data[0].val);
        });
    },
    setUIValue(uikey, value = '', isAttribute = false, attribute = null) {
        if (!uikey) {
            return;
        }
        if (!this.ui[uikey]) {
            console.warn(`Element "${uikey}" not found.`);
            return;
        }
        if (!isAttribute) {
            this.ui[uikey].innerHTML = value;
        }
        else {
            if (attribute) {
                this.ui[uikey].setAttribute(attribute, value);
            }
        }
    },
};

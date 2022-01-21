import { conf } from './conf.js'
export { App }


type apiResponseType = {
    route: Object;
    errors: Array<string>;
    data: Array<[id: number, val: string]>;
}

// type responseHandler = (apiResponse: apiResponseType) => void


const App = {
    conf: conf,
    ui: {},

    apiRequest(request: string, /* responseHandler: responseHandler|null = null */) {
        // Prepare request data.
        const requestData = new FormData()
        requestData.append('r', request)

        // Send request to api.
        return fetch(this.conf.apiEndpointPath, {
            method: 'POST',
            body: requestData,
        })
        // Process the response.
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not OK')
            }
            return response.json()
        })
        // // Pass the response to the onSuccess handler function.
        // .then(responseData => {
        //     if (typeof(responseHandler) == 'function') {
        //         responseHandler(responseData)
        //     }
        // })
        // Sad times.
        .catch(error => {
            console.error('apiRequest Error:', error)
        })
    },

    collectUIElements() {
        document.querySelectorAll('[data-uikey]').forEach(ele => {
            // @ts-ignore
            this.ui[ele.dataset.uikey] = ele
            // @ts-ignore
            ele.classList.add('ui', ele.dataset.uikey)
        })
    },

    main() {
        this.collectUIElements()

        // @ts-ignore
        this.ui.randomness.addEventListener('click', () => { this.refreshRandomness() })

        this.setUIValue('randomness', 'Loading...')
        this.setUIValue('apiEndpointPath', this.conf.apiEndpointPath, true, 'href')

        this.refreshRandomness()
    },

    refreshRandomness() {
        this.setUIValue('errors', '')
        this.setUIValue('randomness', 'Loading...')

        this.apiRequest('').then((response: apiResponseType) => {
            if (!response) {
                return
            }

            if (response.errors.length > 0) {
                this.setUIValue('errors', response.errors.join('<br>'))
                this.setUIValue('randomness', ':-(')
                console.error(response.errors)
                return
            }

            // @ts-ignore
            this.setUIValue('randomness', response.data[0].val)
        })
    },

    setUIValue(uikey: string, value: string = '', isAttribute: boolean = false, attribute: string|null = null) {
        if (!uikey) {
            return
        }

        // @ts-ignore
        if (!this.ui[uikey]) {
            console.warn(`Element "${uikey}" not found.`)
            return
        }

        if (!isAttribute) {
            // @ts-ignore
            this.ui[uikey].innerHTML = value
        }
        else {
            if (attribute) {
                // @ts-ignore
                this.ui[uikey].setAttribute(attribute, value)
            }
        }
    },
}

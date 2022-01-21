import { conf } from './conf.js'
export { App }


type apiResponseType = {
    time: number;
    request: string;
    errors: Array<string>;
    data: Array<{id: number, val: string|number}>;
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

        this.setUIValue('apiEndpointPath', this.conf.apiEndpointPath, true, 'href')

        this.refreshRandomness()
    },

    refreshRandomness() {
        this.setUIValue('errors', '')

        this.apiRequest('').then((response: apiResponseType) => {
            if (!response) {
                return
            }

            if (response.errors.length > 0) {
                this.setUIValue('errors', response.errors.join('<br>'))
                console.error(response.errors)
                return
            }


            let node = response.request.split('/', 2)[0]
            // @ts-ignore
            let id = response.data[0].id
            // @ts-ignore
            let val = response.data[0].val

            let output = `<p>${val}</p>\n<p><em>${node} id:${id}</em></p>`
            this.setUIValue('randomness', output)
        })
    },

    setUIValue(uikey: string, value: string|number = '', isAttribute: boolean = false, attribute: string|null = null) {
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

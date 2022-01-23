export { App }


const App = {
    conf: {
        apiEndpointPath: './api.php',
    },
    ui: {},

    main() {
        this.collectUIElements()

        // @ts-ignore
        this.ui['main'].addEventListener('click', () => { this.refreshRandomItem() })

        // @ts-ignore
        this.ui['main'].style.display = 'flex'
        this.refreshRandomItem()
    },

    collectUIElements() {
        let elements = document.querySelectorAll('[data-uikey]')
        elements.forEach(element => {
            if (element instanceof HTMLElement) {
                let uikey = element.dataset['uikey']
                if (uikey) {
                    element.classList.add('ui', uikey)
                    // @ts-ignore
                    this.ui[uikey] = element
                }
            }
        })
    },

    refreshRandomItem() {
        // @ts-ignore
        this.ui['errors'].innerHTML = ''
        // @ts-ignore
        this.ui['errors'].style.display = 'none'

        this.apiRequest().then((response) => {
            if (!response) {
                return
            }

            if (response.errors.length > 0) {
                console.error('API respone errors:', response.errors)
                // @ts-ignore
                this.ui['errors'].innerHTML = response.errors.join('<br>')
                // @ts-ignore
                this.ui['errors'].style.display = 'block'
                return
            }

            let request = response.request
            let val = response.data[0].val

            // @ts-ignore
            this.ui['random-item'].innerHTML = val

            // @ts-ignore
            this.ui['random-item-info'].innerHTML = `&lt;${request}&gt;`
        })
    },

    apiRequest(request: string = '') {
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
                throw new Error('API network response was not OK')
            }
            return response.json()
        })
        // Sad times.
        .catch(error => {
            console.error('API request error:', error)
            // @ts-ignore
            this.ui['errors'].innerHTML = `API error: ${error}`
        })
    },
}

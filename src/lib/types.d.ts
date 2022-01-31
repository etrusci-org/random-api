type AppType = {
    conf: {
        apiEndpointPath: string
    }
    ui: {
        main: HTMLElement | null
        errors: HTMLDivElement | null
        randomItemValue: HTMLDivElement | null
        randomItemInfo: HTMLDivElement | null
    }
    main(): void
    refreshRandomItem(): void
}

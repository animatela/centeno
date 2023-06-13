interface UseLogger {
    log: (message: string) => void
    logOnDev: (message: string) => void
}

export const useLogger = (): UseLogger => {
    const log = (message: string) => console.log(message)

    const logOnDev = (message: string): void => {
        if (import.meta.env.MODE === 'development') {
            log(message)
        }
    }

    return { log, logOnDev }
}

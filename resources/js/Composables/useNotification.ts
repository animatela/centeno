import { notify } from 'notiwind'

export enum NotifyGroupId {
    Failed = 'failed',
    Warning = 'warning',
    Success = 'success',
    Info = 'info',
}

interface UseNotification {
    showFailedMessage: (title: string, text: string) => void
    showWarningMessage: (title: string, text: string) => void
    showSuccessMessage: (title: string, text: string) => void
    showInfoMessage: (title: string, text: string) => void
}

export const useNotification = (timeout?: number): UseNotification => {
    const ms: number = timeout || 14000

    const showFailedMessage = (title: string, text: string): void => {
        notify({ group: NotifyGroupId.Failed, title, text }, ms)
    }

    const showWarningMessage = (title: string, text: string): void => {
        notify({ group: NotifyGroupId.Warning, title, text }, ms)
    }

    const showSuccessMessage = (title: string, text: string): void => {
        notify({ group: NotifyGroupId.Success, title, text }, ms)
    }

    const showInfoMessage = (title: string, text: string): void => {
        notify({ group: NotifyGroupId.Info, title, text }, ms)
    }

    return {
        showFailedMessage,
        showWarningMessage,
        showSuccessMessage,
        showInfoMessage,
    }
}

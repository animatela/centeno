import axios, { AxiosError, AxiosRequestConfig, AxiosResponse, InternalAxiosRequestConfig } from 'axios'
import { useLogger } from '@/Composables/useLogger'

interface UseAxiosInterceptor {
    onRequest: (config: InternalAxiosRequestConfig) => InternalAxiosRequestConfig
    onResponse: (response: AxiosResponse) => AxiosResponse,
    onErrorResponse: (err: any) => Promise<any>
}

export const useAxiosInterceptor = (): UseAxiosInterceptor => {
    const { logOnDev } = useLogger()

    // Request Interceptor
    const onRequest = (config: InternalAxiosRequestConfig): InternalAxiosRequestConfig => {
        const { method, url } = config;
        // Set Headers Here
        // Check Authentication Here
        // Set Loading Start Here

        logOnDev(`🚀 [API] ${ method?.toUpperCase() } ${ url } | Request`);

        if (method === 'get') {
            config.timeout = 15000;
        }

        return config;
    }

    const onResponse = (response: AxiosResponse): AxiosResponse => {
        const { method, url } = response.config;
        const { status } = response;
        // Set Loading End Here
        // Handle Response Data Here
        // Error Handling When Return Success with Error Code Here
        logOnDev(`🚀 [API] ${ method?.toUpperCase() } ${ url } | Response ${ status }`);

        return response;
    }

    const onErrorResponse = (error: AxiosError | Error): Promise<AxiosError> => {
        if (axios.isAxiosError(error)) {
            const { message } = error;
            const { method, url } = error.config as AxiosRequestConfig;
            const { statusText, status } = error.response as AxiosResponse ?? {};

            logOnDev(
                `🚨 [API] ${ method?.toUpperCase() } ${ url } | Error ${ status } ${ message }`
            );

            switch (status) {
                case 401: {
                    // "Login required"
                    break;
                }
                case 403: {
                    // "Permission denied"
                    break;
                }
                case 404: {
                    // "Invalid request"
                    break;
                }
                case 500: {
                    // "Server error"
                    break;
                }
                default: {
                    // "Unknown error occurred"
                    break;
                }
            }

            if (status === 401) {
                // Delete Token & Go To Login Page if you required.
                sessionStorage.removeItem('token');
            }
        } else {
            logOnDev(`🚨 [API] | Error ${ error.message }`);
        }

        return Promise.reject(error);
    }

    return {
        onRequest,
        onResponse,
        onErrorResponse,
    }
}

import { ofetch } from "ofetch";
import { ApiTypes } from "../types/enums";

export default class BaseRepository {
    protected baseUrl = import.meta.env.VITE_BE_API_BASE_URL;

    public request<T>(
        method: ApiTypes = ApiTypes.GET,
        path: string,
        payload?: Record<string, unknown>|null,
        authToken: string|null = null,
        withCredentials: boolean = false,
        headers?: Record<string, unknown>
    ): Promise<T> {
        let url = `${this.baseUrl}${path}`;
        const fetchOptions = {
            method: method,
            headers: {
                'Accept': 'application/json'
            },
            body: undefined
        };

        if (withCredentials) {
            fetchOptions.credentials = 'include';
        }

        if (authToken && authToken?.length) {
            fetchOptions.headers.Authorization = `Bearer ${authToken}`;
        }

        if (headers && Object.keys(headers).length) {
            fetchOptions.headers = {
                ...fetchOptions.headers,
                ...headers
            }
        }

        if (method === ApiTypes.GET || method === ApiTypes.OPTIONS) {
            fetchOptions.query = payload;
        } else {
            fetchOptions.body = JSON.stringify(payload);
        }

        return ofetch<T>(url, fetchOptions);
    }
}
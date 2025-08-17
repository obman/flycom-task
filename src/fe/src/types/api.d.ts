export interface TaskResponse {
    value: number;
    label: string;
}

export interface AircraftsByTaskResponse {
    id: number;
    name: string;
}

export interface DatesResponse {
    id: number;
    date: Date;
}

export interface ReservationPayload {
    dates: Date[];
    task: number;
    aircraft: number;
    mode: string;
}

export interface ReservationResponse {
    code: string;
}
import BaseRepository from "@/repositories/Base";
import {ApiTypes} from "@/types/enums";

export default class ReservationRepository extends BaseRepository {
    private path = 'reservation';

    public getAllTask(): Promise<TaskResponse[]> {
        return this.request<TaskResponse[]>(ApiTypes.GET, `/${this.path}/tasks`);
    }

    public getAircraftsByTask(taskId: number): Promise<AircraftsByTaskResponse[]> {
        return this.request<AircraftsByTaskResponse[]>(ApiTypes.GET, `/${this.path}/aircrafts/${taskId}`);
    }

    public getReservedDates(taskId: number, aircraftId: number, month: Date): Promise<DatesResponse[]> {
        return this.request<DatesResponse[]>(ApiTypes.GET, `/${this.path}/${taskId}/${aircraftId}/${month}`);
    }

    public postReserveDates(payload: ReservationPayload): Promise<ReservationResponse> {
        return this.request<ReservationResponse>(ApiTypes.POST, `/${this.path}`, payload);
    }
}
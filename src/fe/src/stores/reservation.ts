import ReservationRepository from '@/repositories/Reservation';
import { defineStore } from 'pinia';
import dayjs from 'dayjs';

const reservation = new ReservationRepository();
export const useReservationStore = defineStore('reservation', {
    state() {
        return {
            localTasks: [] as TaskResponse[],
            localAircrafts: [] as AircraftsByTaskResponse[],
            localDates: [] as Date[]
        }
    },
    getters: {
        tasks(state): TaskResponse[]|[] {
            return state.localTasks;
        },
        aircrafts(state): AircraftsByTaskResponse[]|[] {
            return state.localAircrafts;
        },
        dates(state): Date[]|[] {
            return state.localDates;
        }
    },
    actions: {
        async getAllTasks(): Promise<void> {
            const response: TaskResponse[] = await reservation.getAllTask();
            this.localTasks = response?.data;
        },
        async getAircrafts(taskId: number): Promise<void> {
            const response: AircraftsByTaskResponse[] = await reservation.getAircraftsByTask(taskId);
            this.localAircrafts = response?.data;
        },
        async getReservationDates(taskId: number, aircraftId: number, month: Date): Promise<void> {
            const response: DatesResponse[] = await reservation.getReservedDates(taskId, aircraftId, month);
            this.localDates = response?.data?.map((item) => dayjs(item.date).toDate());
        },
        async storeReservationDates(payload: ReservationPayload): Promise<string|null> {
            const response: ReservationResponse = await reservation.postReserveDates(payload);
            return response?.code;
        }
    }
});
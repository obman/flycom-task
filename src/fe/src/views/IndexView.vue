<template>
    <FlycomLoadingContainer :loading="containerLoading">
        <div class="fc-reservation max-w-144 mx-auto">
            <div class="mb-12">
                <div
                    v-if="tasks?.length"
                    class="card flex justify-center mb-6"
                >
                    <Select
                        v-model="selectedTask"
                        :options="tasks"
                        :loading="componentLoading"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Select a Task"
                        class="w-full md:w-56"
                    />
                </div>
                <div
                    v-if="aircrafts?.length"
                    class="card flex justify-center"
                >
                    <Select
                        v-model="selectedAircraft"
                        :options="aircrafts"
                        :loading="componentLoading"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Select an Aircraft"
                        class="w-full md:w-56"
                    />
                </div>
            </div>

            <div
                v-if="isDatepickerVisible"
            >
                <div class="flex justify-center mb-6">
                    <label class="flex items-center gap-1 mr-4">
                        <input
                            v-model="selectedMode"
                            type="radio"
                            value="range"
                        />
                        Range
                    </label>
                    <label class="flex items-center gap-1">
                        <input
                            v-model="selectedMode"
                            type="radio"
                            value="multiple"
                        />
                        Multiple
                    </label>
                </div>

                <DatePicker
                        v-model="selectedDates"
                        :selectionMode="selectedMode"
                        :disabledDates="dates"
                        inline
                        class="!block mx-auto"
                    />
                    <Button
                        type="submit"
                        severity="primary"
                        :disabled="isSubmitDisabled"
                        :loading="componentLoading"
                        label="Submit"
                        @click="onSubmit"
                    />
            </div>
        </div>
    </FlycomLoadingContainer>
</template>
<script lang="ts">
import FlycomLoadingContainer from "@/components/elements/FlycomLoadingContainer.vue";
import { useReservationStore } from "@/stores/reservation";
import {mapState, mapActions} from "pinia";
import dayjs from 'dayjs';
import { ToastTypes } from "@/types/enums";

export default {
    data() {
        return {
            containerLoading: false,
            componentLoading: false,
            selectedTask: null,
            selectedAircraft: null,
            selectedMode: 'multiple',
            selectedMonth: dayjs().format('MM-YYYY'),
            selectedDates: [],
        }
    },
    async mounted() {
        await this.fetchTasks();
    },
    computed: {
        isDatepickerVisible(): boolean {
            return this.tasks?.length && this.aircrafts?.length &&
                this.selectedTask && this.selectedAircraft;
        },
        isSubmitDisabled(): boolean {
            return !this.selectedDates?.length || this.componentLoading;
        },
        ...mapState(useReservationStore, ['tasks', 'aircrafts', 'dates'])
    },
    methods: {
        async fetchTasks(): Promise<void> {
            this.containerLoading = true;
            try {
                await this.getAllTasks();
            } catch (error: Error) {
                const msg = error?.data?.message || error.message || 'Something went wrong';
                this.$toast.add({ severity: ToastTypes.ERROR, summary: 'Failed fetching tasks.', detail: msg, life: 4000 });
            } finally {
                this.containerLoading = false;
            }
        },
        async fetchAircrafts(): Promise<void> {
            this.componentLoading = true;
            try {
                await this.getAircrafts(this.selectedTask);
            } catch (error: Error) {
                const msg = error?.data?.message || error.message || 'Something went wrong';
                this.$toast.add({ severity: ToastTypes.ERROR, summary: 'Failed fetching aircrafts.', detail: msg, life: 4000 });
            } finally {
                this.componentLoading = false;
            }
        },
        async fetchAvailableDates(): Promise<void> {
            this.componentLoading = true;
            try {
                await this.getReservationDates(this.selectedTask, this.selectedAircraft, this.selectedMonth);
            } catch (error: Error) {
                const msg = error?.data?.message || error.message || 'Something went wrong';
                this.$toast.add({ severity: ToastTypes.ERROR, summary: 'Failed fetching reserved dates.', detail: msg, life: 4000 });
            } finally {
                this.componentLoading = false;
            }
        },
        async onSubmit(): Promise {
            const normalizedDates = this.selectedDates.map((date: Date) => dayjs(date).startOf('day').format('YYYY-MM-DD'));

            const payload = {
                dates: normalizedDates,
                task: this.selectedTask,
                aircraft: this.selectedAircraft,
                mode: this.selectedMode
            } as ReservationPayload;
            this.componentLoading = true;
            try {
                const statusMsg = await this.storeReservationDates(payload);
                this.$toast.add({ severity: ToastTypes.SUCCESS, summary: 'Aircraft reserved.', detail: statusMsg, life: 4000 });
            } catch (error: Error) {
                const msg = error?.data?.message || error.message || 'Something went wrong';
                this.$toast.add({ severity: ToastTypes.ERROR, summary: 'Failed saving reservation.', detail: msg, life: 4000 });
            } finally {
                this.componentLoading = false;
            }
        },
        ...mapActions(useReservationStore, ['getAllTasks', 'getAircrafts', 'getReservationDates', 'storeReservationDates'])
    },
    watch: {
        selectedTask(newTask) {
            if (newTask) {
                this.fetchAircrafts();
            }
        },
        selectedAircraft(newAircraft) {
            if (newAircraft) {
                this.fetchAvailableDates();
            }
        }
    },
}
</script>
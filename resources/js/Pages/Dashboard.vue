<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { ref } from 'vue';
const pusher = new Pusher("241e9ac027efb31a8830", {
                cluster: "us2",
})
const listIbeaconListen = ref([]);
  const channel = pusher.subscribe('channel-response-ibeacon-service');
    channel.bind('services-response-ibeacon-service-event', function(data) {
      listIbeaconListen.value.push(data)
    console.log({ listIbeaconListen })
    });
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class=" max-w-[70%]  mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                    <thead class="border-b">
                                        <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Name
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Area
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Date Incoming
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Date Leave
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b" v-for="(ib, item) in listIbeaconListen" :key="item">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ ib.message.Name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ ib.message.Area }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <p v-show="ib.message.Date_Incoming">Incoming at</p>   {{ ib.message.Date_Incoming }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                 <p v-show="ib.message.Date_Leave">Leave at</p> {{ ib.message.Date_Leave }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<template>
    <div class="bg-surface rounded border pa-4">
        <v-table>
            <thead>
                <tr>
                    <th class="text-left">Vehicle</th>
                    <th class="text-left">Year / CC</th>
                    <th class="text-left">Mileage</th>
                    <th class="text-left">Transmission</th>
                    <th class="text-left">Grade</th>
                    <th class="text-left">Date Time</th>
                    <th class="text-left">Auction House</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="i in 5" :key="i">
                    <td>Vehicle {{ i }}</td>
                    <td>Grade {{ i }}</td>
                    <td>£{{ (10000 + i * 100).toLocaleString() }}</td>
                    <td>£{{ (9500 + i * 100).toLocaleString() }}</td>
                    <td>£{{ (9000 + i * 100).toLocaleString() }}</td>
                    <td>£{{ (11000 + i * 100).toLocaleString() }}</td>
                    <td>{{ `2024-11-${10 + i}` }}</td>
                </tr>
            </tbody>
        </v-table>
    </div>

</template>

<script></script>

<template>
    <div class="bg-surface rounded border pa-4">
        <v-table>
            <thead>
                <tr>
                    <th class="text-left">Vehicle</th>
                    <th class="text-left">Grade</th>
                    <th class="text-left">Cap Clean</th>
                    <th class="text-left">Cap Average</th>
                    <th class="text-left">Cap Below</th>
                    <th class="text-left">Autotrader Retail</th>
                    <th class="text-left">Date Time</th>
                    <th class="text-left">Autoboli</th>
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
                    <td>
                        <v-chip :color="i % 2 === 0 ? 'success' : 'warning'" size="small" variant="flat">
                            {{ i % 2 === 0 ? 'Active' : 'Pending' }}
                        </v-chip>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </div>

</template>

<script></script>

<template>
    <div>
        <input
            type="text"
            v-model="search"
            class="form-control mb-3"
            placeholder="Search tickets..."
        >

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ticket Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="ticket in filteredTickets" :key="ticket.id">
                    <td>{{ ticket.name }}</td>
                    <td>₹{{ Number(ticket.price).toFixed(2) }}</td>
                    <td>{{ ticket.quantity }}</td>
                </tr>

                <tr v-if="filteredTickets.length === 0">
                    <td colspan="3" class="text-center">
                        No tickets found.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        tickets: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            search: ''
        };
    },

    computed: {
        filteredTickets() {
            return this.tickets.filter(ticket =>
                ticket.name.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    }
};
</script>
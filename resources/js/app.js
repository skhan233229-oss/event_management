import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import TicketList from './TicketList.vue';

window.Alpine = Alpine;

Alpine.start();

// Vue Ticket List
const ticketElement = document.getElementById('ticket-list');

if (ticketElement) {
    const tickets = JSON.parse(ticketElement.dataset.tickets);

    createApp(TicketList, {
        tickets: tickets
    }).mount(ticketElement);
}
import './bootstrap';
import './ckeditor.js';
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start();//
// //
//
import {createApp} from 'vue';
//
import BidCountdownTimer from "./components/BidCountdownTimer.vue";
import NewBid from "./components/NewBid.vue";

import LotStatusBadge from "./components/LotStatusBadge.vue";
import UserPurchases from "./components/UserPurchases.vue";
//
const app = createApp({});
//
app.component('BidCountdownTimer', BidCountdownTimer);
app.component('NewBid', NewBid);
app.component('LotStatusBadge', LotStatusBadge);
app.component('UserPurchases', UserPurchases);
//
app.mount("#app")
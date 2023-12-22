<template>
    <div class="flex flex-row">
        <svg class="w-4 mr-1"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
             fill="currentColor">
            <path
                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"/>
        </svg>
        <span>{{ uniqueBids + declension() }}</span>

    </div>
    <div class="flex">
        <svg class="w-4 mr-1"
             xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
        </svg>
        <span>
         ${{ maxBid }}
    </span>
    </div>
</template>

<script>
export default {
    name: 'NewBid',
    props: ['lot', 'bid','unique'],
    data() {
        return {
            maxBid: this.bid,
            lotId: this.lot,
            uniqueBids: this.unique,

        }
    },
    mounted() {
        this.updateTheBid()
        setInterval(() => {
            this.updateTheBid()
        }, 2000)
    },
    methods: {
        updateTheBid() {
            axios.get('/api/lot_bid?lot_id=' + this.lotId)
                .then(response => {
                    this.maxBid = response.data.maxBid;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        declension() {
            return this.uniqueBids === 1 ? this.$t(' bid')  : this.$t(' bids')
        },
    }
}
</script>

export default {
    data() {
        return {
            socket: io('http://localhost:6001'),
            event: "Bid:NewBid"
        }
    }
}
import ApiService from "./apiService";

class BookableService {
    async getPickupAndReturnOptions() {
        return ApiService.withoutAuth().get("/pickup-and-return-points");
    }
    async getStockStatus(bookableId, fromDate, fromTime, toDate, toTime) {
        return ApiService.withoutAuth().get(`/bookables/${bookableId}/stock?fromDate=${fromDate}&fromTime=${fromTime}&toDate=${toDate}&toTime=${toTime}`);
    }
    async getPrice(bookableId, fromDate, fromTime, toDate, toTime) {
        return ApiService.withoutAuth().get(`/bookables/${bookableId}/price?fromDate=${fromDate}&fromTime=${fromTime}&toDate=${toDate}&toTime=${toTime}`);
    }
    async getBookables(payload) {
        return ApiService.withoutAuth().get("/bookables", {payload});
    }
}

export default new BookableService();

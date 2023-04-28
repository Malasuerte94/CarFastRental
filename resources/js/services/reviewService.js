import ApiService from "./apiService";

class ReviewService {
    async getReview(reviewId) {
        return ApiService.withoutAuth().get(`/reviews/${reviewId}`);
    }
    async getBookableReview(bookableId) {
        return ApiService.withoutAuth().get(`/booking-by-review/${bookableId}`);
    }
    async getBookableReviews(bookableId) {
        return ApiService.withoutAuth().get(`/bookables/${bookableId}/reviews`);
    }
    async postBookableReview(payload) {
        return ApiService.withoutAuth().get(`/reviews`, payload);
    }
}

export default new ReviewService();

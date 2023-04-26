import ApiService from "./apiService";

class SettingsService {
    async getHeroProducts() {
        return ApiService.withoutAuth().get("/hero-products");
    }
    async getFeatureCardIcons() {
        return ApiService.withoutAuth().get("/feature-card-icons");
    }
    async getFaqs() {
        return ApiService.withoutAuth().get("/faqs");
    }
    async getSettings() {
        return ApiService.withoutAuth().get("/settings");
    }
}

export default new SettingsService();

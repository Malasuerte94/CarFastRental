import ApiService from "./apiService";

class SettingsService {
    async getHeroProducts() {
        return ApiService.withoutAuth().get("/hero-products");
    }
    async getFeatureCardIcons() {
        return ApiService.withoutAuth().get("/feature-card-icons");
    }
}

export default new SettingsService();

import ApiService from "./apiService";

class SettingsService {
    async getHeroProducts() {
        return ApiService.withoutAuth().get("/hero-products");
    }
}

export default new SettingsService();

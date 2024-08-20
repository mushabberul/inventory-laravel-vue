export default{
    appName: "InventoryApp",
    appVersion: "1.0.0",
    defaultDataLimit: 10,
    base_url:"http://127.0.0.1:8000",
    inventoryAPIHost: import.meta.env.VITE_API_URL,
    apiToken: localStorage.getItem('token'),
    requestTimeOute: 5000
}
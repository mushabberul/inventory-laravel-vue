import axios from "axios";
import config from '../utils/config';

const inventoryAxiosClient = axios.create({
    baseURL: config.inventoryAPIHost+'/api',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Authorization': 'Bearer '+config.apiToken,
         "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS"
    }
});

const baseClient = axios.create({
    baseURL: config.inventoryAPIHost,
    headers: {
        "Accept": 'application/json',
        "Content-Type": 'application/json',
        "X-Requested-With": 'XMLHttpRequest'
    }
});


export {
    baseClient,
    inventoryAxiosClient
}
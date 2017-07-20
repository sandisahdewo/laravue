import axios from 'axios'

import { getToken, isAuthenticated } from '../helpers/authenticated'

export function get(url) {
	return axios({
		method: 'GET',
		url:url,
		headers: {
			'Authorization': 'Bearer ' + getToken()
		}
	})
}

export function del(url) {
	return axios({
		method: 'DELETE',
		url:url,
		headers: {
			'Authorization': 'Bearer ' + getToken()
		}
	})
}

export function post(url, data) {
	return axios({
		method: 'POST',
		url:url,
		data:data,
		headers: {
			'Authorization': 'Bearer ' + getToken()
		}
	})
}
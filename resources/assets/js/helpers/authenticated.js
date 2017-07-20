import Auth from '../store/auth'
import Flash from '../helpers/flash'

export function getToken() {
	Auth.initialize()
	return Auth.state.api_token
}

export function isAuthenticated() {
	if(getToken())
		return true
	else 
		return false
}
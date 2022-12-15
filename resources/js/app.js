import './bootstrap';
import { createApp } from "vue";
import { createStore } from "vuex";
import App from './App.vue';


const store = createStore({
    state() {
        return {
            weather: undefined,
            weatherError: false,
        }
    },
    mutations: {
        setWeather(state, payload) {
            state.weather = payload;
        },
        setWeatherError(state, payload) {
            state.weatherError = payload;
        },
    },
    actions: {
        async getWeather({state, commit}, location) {
            const resp = await fetch(`/weather/${location}`);
            if (resp.status === 200) {
                const body = await resp.json();
                if (state.weatherError === true) {
                    commit('setWeatherError', false);
                }
                commit('setWeather', body);
                return;
            }

            commit('setWeatherError', true);
            return;
        }
    }
})

createApp(App)
    .use(store)
    .mount('#app');


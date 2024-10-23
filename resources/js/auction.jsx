import React from 'react';
import store from "./redux/store";
import App from './components/App';
import {Provider} from "react-redux";
import {createRoot} from 'react-dom/client';

const rootElement = document.getElementById('app');
const app = createRoot(rootElement);

app.render(
    <Provider store={store}>
        <App/>
    </Provider>
);

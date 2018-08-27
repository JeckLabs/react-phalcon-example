import React from 'react';
import ReactDOM from 'react-dom';

import Button from '@material-ui/core/Button';
import SimpleCard from './SimpleCard';

class HelloButton extends Button {
    render() {
        return <Button {...this.props}>Hello, {this.props.name}</Button>;
    }
}

const COMPONENT_MAP = {
    Button: Button,
    HelloButton: HelloButton,
    SimpleCard: SimpleCard
};

window.add_component = function (name, bind_to) {
    console.log(name, bind_to);
    if (COMPONENT_MAP[name] === undefined) {
        return null;
    }
    const root = document.getElementById(bind_to);
    if (!root) {
        return null;
    }
    let props = null;
    if (root.dataset.props !== undefined) {
        props = JSON.parse(root.dataset.props);
    }
    const component = React.createElement(COMPONENT_MAP[name], props);
    return ReactDOM.render(component, root);
};

if (window.__components_queue !== undefined) {
    window.__components_queue.forEach(function (elm) {
        window.add_component(...elm);
    })
}
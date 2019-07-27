function post(path, data) {

    const params = {
        method: 'Post',
        headers: {
            'content-type': 'application/json',
        },
        body: JSON.stringify(data)
    }
    return window.fetch(path, params)
        .then(response => {
            if (!response.ok)
                throw new Error('Error')
            return response
        })
        .then(response => response.json())

}

function put(path, data, id) {

    const params = {
        method: 'Put',
        headers: {
            'content-type': 'application/json',
        },
        body: JSON.stringify(data)
    }
    return window.fetch(path+'/'+id, params)
        .then(response => {
            if (!response.ok)
                throw new Error('Error')
            return response
        })
        .then(response => response.json())
}

function get (path) {

    const params = {
        method: 'GET',
        headers: {
            'content-type': 'application/json',
        }
    }
    return window.fetch(path, params)
        .then(response => {
            if (!response.ok)
                throw new Error('Error')
            return response
        })
        .then(response => response.json())
}

function remove (path, id) {

    const params = {
        method: 'DELETE',
        headers: {
            'content-type': 'application/json',
        }
    }
    return window.fetch(path+'/'+id, params)
        .then(response => {
            if (!response.ok)
                throw new Error('Error')
            return response
        })
        .then(response => response.json())
}

export {post, get, put, remove}
import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';

/**
 * Message response alert
 * choose banner background color according to the type of message success
 * @param type
 * @param message
 * @returns {JSX.Element}
 * @constructor
 */
const ResponseMessage = ({ type, message }) => {
    return (<div className={type == "Error" ? 'alert alert-danger text-center' : 'alert alert-success text-center'} role="alert">
        {message}
    </div>);
}


/**
 * Add job to the list
 * @returns {JSX.Element}
 * @constructor
 */
function AddJob() {
    const [formData, setFormData] = useState({
        summary: "",
        description: "",
        property: "",
        submitted: false,
        listProperties: null,
    });

    const [errorMessage, setErrorMessage] = useState({type: '', message: ""});
    const [errors, setErrors] = useState({});

    const formValidation = (formData) => {
        const { summary, description, property } = formData;
        const errors = {};
        if (!summary) errors.summary = "Summary is required";
        if (!description) errors.description = "Description is required";
        if (!property) errors.property = "Property field is required";
        return errors;
    };

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });
    };

    let propertyList = null;
    const findPropertyList = () => {
        window.axios.get("property-list").then(resp => {
            if (resp.data.message == "success") {
                propertyList = resp.data.data.properties;

                // check first if no property added first, then I can loop the list
                let listPropertiesFinal = <React.Fragment><option value="">No Property available</option></React.Fragment>;
                if(propertyList.length > 0){
                    listPropertiesFinal = propertyList.map((job, itemId) => <React.Fragment>
                        {itemId == 0 ? <option>Select a property</option> : ''}
                        <option value={job.id}>{job.name}</option>
                    </React.Fragment>);
                }
                setFormData({
                    listProperties: listPropertiesFinal
                });
            }
        }).catch(error => {
            setErrorMessage({
                type: 500,
                message: error
            });
        });
    }

    // as soon as the page is loaded I retrieve the property list
    useEffect(() => {
        findPropertyList();
    }, [propertyList]);


    // Store new property after validation
    const storeJob = (e) => {

        e.preventDefault();
        const errors = formValidation(formData);
        setErrors(errors);

        // prepare data for API: payload
        const contact = {
            summary: formData.summary,
            description: formData.description,
            property: formData.property,
            user: 1
        };

        // check if any error
        if (Object.keys(errors).length === 0) {

            // send data
            axios.post(`store-job`,
                contact
            ).then((res) => {
                console.log(res);
                setErrorMessage({
                    type: 'Success',
                    message: "Job successfully logged, check on the list the job just added."
                });

                // delete all fields
                setFormData({
                    summary: "",
                    description: ""
                });

                // reload properties list
                findPropertyList();

            }).catch((err) => {
                let errorMessage = "";
                if(err.response && err.response.data){
                    errorMessage = "The following is the message received: " + err.response.data.message;
                }
                setErrorMessage({
                    type: 'Error',
                    message: "An error has occurred please try again or contact customer service. \r\n " + errorMessage
                });
            });
        }
    }

    return (
        <div className="row">
            <div className="col-md-8 offset-md-2">

                <h3 className="text-center border-bottom-1">Log a job</h3>
                <p><a href="/property-jobs/" className="btn btn-primary" target="_blank">Properties List</a> </p>
                <hr />
                {errorMessage.message !== "" && (
                    <ResponseMessage type={errorMessage.type} message={errorMessage.message} />
                )}
                <form onSubmit={(e) => storeJob(e)}>
                    <div className="form-group row mb-3">
                        <label htmlFor="colFormLabelSm"
                               className="col-sm-2 col-form-label col-form-label-md">Summary</label>
                        <div className="col-sm-10">
                            <input type="text" className="form-control form-control-md" id="summary" name="summary"
                                   placeholder="Summary"  value={formData.summary} onChange={handleChange}/>
                            {Object.keys(errors).includes("summary") && errors.summary && (
                                <strong className="text-left text-danger"><label>{errors.summary}</label></strong>
                            )}
                        </div>

                    </div>
                    <div className="form-group row mb-3">
                        <label htmlFor="colFormLabel" className="col-sm-2 col-form-label">Description</label>
                        <div className="col-sm-10">
                            <input type="text" className="form-control form-control-md" id="description"
                                   name="description"
                                   placeholder="Description" value={formData.description} onChange={handleChange}/>
                            {Object.keys(errors).includes("description") && errors.description && (
                                <strong className="text-left text-danger"><label>{errors.description}</label></strong>
                            )}
                        </div>
                    </div>
                    <div className="form-group row mb-3">
                        <label htmlFor="colFormLabelLg"
                               className="col-sm-2 col-form-label col-form-label-md">Property</label>
                        <div className="col-sm-10">
                            <select className="form-control" name="property"  onChange={handleChange}>
                                {formData.listProperties}
                            </select>
                            {Object.keys(errors).includes("property") && errors.property && (
                                <strong className="text-left text-danger"><label>{errors.property}</label></strong>
                            )}
                        </div>
                    </div>
                    <hr />
                    <div className="form-group row mb-3 text-right">
                        <label htmlFor="colFormLabelLg" className="col-sm-2 col-form-label col-form-label-md"></label>
                        <div className="col-sm-10 text-right">
                            <button type="submit" className="btn btn-primary" value="Submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
}

export default AddJob;

if (document.getElementById('addJob')) {
    ReactDOM.render(<AddJob/>, document.getElementById('addJob'));
}

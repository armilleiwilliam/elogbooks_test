import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';


const EditButton = ({idJob}) => {
    return <a href={"edit/" + idJob} className="btn btn-primary">Edit</a>;
}

/**
 * Show list of jobs for properties listed
 * @returns {JSX.Element}
 * @constructor
 */
function JobsList() {
    const [listJobs, setListJobs] = useState({
        postdata: [],
    });

    const [errorMessage, setErrorMessage] = useState({type: '', message: ""});
    let propertyData = null;

    // as soon as the page is loaded I retrieve the jobs list
    useEffect(() => {
        window.axios.get("jobs-list").then(resp => {
            if (resp.data.message == "success") {
                propertyData = resp.data.data.jobs;

                // check first if no job added, otherwise I loop the list returned
                let postdata = <React.Fragment><tr><td colspan='6'>No job added</td></tr></React.Fragment>;
                if(propertyData.length > 0){
                    postdata = propertyData.map((job, itemId) => <React.Fragment>
                        <tr>
                            <td>{itemId + 1}</td>
                            <td>{job.summary}</td>
                            <td>{job.status}</td>
                            <td>{job.property}</td>
                            <td>{job.created_by}</td>
                            <td>{job.created_at}</td>
                            <td> <EditButton idJob={job.id} /></td>
                        </tr>
                    </React.Fragment>);
                }

                setListJobs({
                    postdata
                });
            }
        }).catch(error => {
            setErrorMessage({
                type: 500,
                message: error
            });
        });
    }, [propertyData]);

    return (
        <div>
            {errorMessage.message !== "" && (
                <div><h4>List of jobs could not be retrieved</h4><p>({errorMessage.message})</p></div>
            )}
            <table className="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Summary</th>
                    <th>Status</th>
                    <th>Porperty name</th>
                    <th>Created by</th>
                    <th>Created</th>
                    <th>Controller</th>
                </tr>
                </thead>
                <tbody>
                {listJobs.postdata}
                </tbody>
            </table>
        </div>
    );
}

export default JobsList;

if (document.getElementById('listJobs')) {
    ReactDOM.render(<JobsList/>, document.getElementById('listJobs'));
}

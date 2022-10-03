import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import ReactPaginate from 'react-paginate';
import "./../../css/custom.css";


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
        postData: [],
        total: null,
        per_page:null,
        current_page: 1,
        active: false,
    });

    const [errorMessage, setErrorMessage] = useState({type: '', message: ""});
    let propertyData = null;
    let pageNumber = null;

    // as soon as the page is loaded I retrieve the jobs list
    useEffect(() => {
        makeHttpRequestWithPage(1);
    }, [propertyData, pageNumber]);

    const handlePageClick = (e) => {
        const selectedPage = e.selected;
        const offset = selectedPage * listJobs.perPage;

        setListJobs({
            currentPage: selectedPage,
            offset: offset,
        });
        makeHttpRequestWithPage(selectedPage + 1);
    };

    const makeHttpRequestWithPage = pageNumber => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

        window.axios.get(`jobs-list/${pageNumber}`).then(resp => {
            if (resp.data.message == "success") {
                propertyData = resp.data.data.jobs;
                let jobs = propertyData.jobs

                // check first if no job added, otherwise I loop the list returned
                let postData = <React.Fragment><tr><td colspan='6'>No job added</td></tr></React.Fragment>;
                if(jobs.length > 0){
                    postData = jobs.map((job, itemId) => <React.Fragment>
                        <tr>
                            <td>{((pageNumber - 1) * 10) + itemId + 1}</td>
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
                    postData,
                    total: propertyData.total,
                    per_page: propertyData.per_page,
                    current_page: propertyData.current_page,
                    active: propertyData.current_page,
                });
            }
        }).catch(error => {
            setErrorMessage({
                type: 500,
                message: error
            });
        });
    }


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
                {listJobs.postData}
                </tbody>
            </table>
            {listJobs.total != 0 &&
                <nav aria-label="...">
                <ReactPaginate
                    previousLabel={"<<"}
                    nextLabel={">>"}
                    breakLabel={"..."}
                    breakClassName={"page-item"}
                    pageCount={Math.ceil(listJobs.total / listJobs.per_page)}
                    marginPagesDisplayed={2}
                    pageRangeDisplayed={5}
                    onPageChange={handlePageClick}
                    containerClassName={"pagination"}
                    subContainerClassName={"page-item"}
                    activeClassName={"active"}/>
                </nav>
            }
        </div>
    );
}

export default JobsList;

if (document.getElementById('listJobs')) {
    ReactDOM.render(<JobsList/>, document.getElementById('listJobs'));
}

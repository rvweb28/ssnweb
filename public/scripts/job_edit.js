// def nextId

function save() {

  $.post(jobs_url + "/bearbeiten",
  {
    jobs: getJobs()
  },
  function(data, status) {

    if(data == 'ok') window.location = jobs_url;
  });
}

function newJob() {

  var job = $("#new_job").val();
  $("#new_job").val('');

  jobs['id-' + nextId] = job;
  data['id-' + nextId] = job;

  var html = '<div class="id-' + nextId + '" style="margin-bottom: 3px;"><button type="button" class="btn btn-danger" onclick="removeJob($(this), ' + nextId + ')">&times;</button> <span id="job-name-' + nextId + '">' + job + '</span></div>';

  $('#jobs').append(html);

  nextId++;
}

function removeJob(caller, id) {

  if(caller.html() == '×') {

    jobs['id-' + id] = "";
    caller.html('&gt;');
    caller.removeClass('btn-danger');
    caller.addClass('btn-success');
    $('#job-name-' + id).addClass('line-through');

  } else {

    jobs['id-' + id] = data['id-' + id];
    caller.html('×');
    caller.removeClass('btn-success');
    caller.addClass('btn-danger');
    $('#job-name-' + id).removeClass('line-through');
  }
}

function getJobs() {

  var tmp = '';

  for(var key in jobs) {

    if(jobs[key] == '') continue;
    tmp += jobs[key] + '\n';
  }

  console.log(tmp);
  return tmp;
}

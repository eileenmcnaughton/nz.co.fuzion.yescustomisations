<h3> {ts}Project Status{/ts}</h3>
<p>{ts 1=$currentTime}as at %1{/ts}</p>
<table>
  <tr>
    <td>Payments received</td>
    <td>{$total_received|crmMoney}</td>
  </tr>
  <tr>
    <td>Payments pledged</td>
    <td>{$pledge_balance|crmMoney}</td>
  </tr>
  <tr>
    <td><h3>Total Raised</h3></td>
    <td><h3>{$raised|crmMoney}</h3></td>
  </tr>
  <tr>
    <td>Still to go</td>
    <td>{$to_raise|crmMoney}</td>
  </tr>
  <tr>
    <td>Percent achieved</td>
    <td>{$percent}%</td>
  </tr>
</table>
